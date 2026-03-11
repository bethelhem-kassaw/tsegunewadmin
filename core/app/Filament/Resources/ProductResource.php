<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?string $recordTitleAttribute = 'name';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\TextInput::make('price')->required()->numeric(),
                    Forms\Components\Select::make('main_category')
                        ->label('Main category')
                        ->required()->multiple()->preload()
                        ->relationship(name: 'mainCategory', titleAttribute: 'name')
                        ->reactive()
                        ->afterStateUpdated(fn(callable $set) => $set('sub_category_id', null)),
                    Forms\Components\Select::make('sub_category_id')
                        ->label('Sub category')
                        ->searchable()
                        ->required()
                        ->options(function (callable $get) {
                            $sub = SubCategory::where('main_category_id', $get('main_category_id'))->get();
                            if (!count($sub)) {
                                return SubCategory::all()->pluck('name', 'id');
                            }
                            return $sub->pluck('name', 'id');
                        }),
                    // Add this to your Form schema array
                    Forms\Components\Select::make('product_type')
                        ->label('Product Source')
                        ->options([
                            'inspiration' => 'Inspiration (Gallery)',
                            'in-house' => 'In-house Made',
                        ])
                        ->default('in-house')
                        ->required()
                        ->selectablePlaceholder(false)
                        ->native(false), // Gives it a cleaner Filament look
                    // ->icons([
                    //     'inspiration' => 'heroicon-m-light-bulb',
                    //     'in-house' => 'heroicon-m-building-storefront',
                    // ]),
                    Forms\Components\TextInput::make('ammount_in_stock')->default(1)->numeric(),
                    Forms\Components\TextInput::make('size')->label('Size in Kg')->numeric(),
                    Forms\Components\TextInput::make('supporting_name'),
                    Forms\Components\Textarea::make('description')->required(),
                    Forms\Components\FileUpload::make('photos')
                        ->image()
                        ->multiple()
                        ->maxFiles(5)
                        ->minFiles(1)
                        ->enableReordering()
                        ->directory('ProductPhotos'),
                    Forms\Components\Textarea::make('top_description')->nullable(),
                    Forms\Components\Toggle::make('instock')->default(1),
                    Forms\Components\Hidden::make('stakeholder_id')->default(auth('stakeholder')->user()->id),
                    Forms\Components\Hidden::make('company_id')->default(auth('stakeholder')->user()->company_id),

                    // options s

                    //   Toggle::make('has_text')->default(false),
                    //   Toggle::make('has_Images')->default(false),
                    //   Toggle::make('is_package')->default(false),
                    Toggle::make('featured')->default(false),


                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photos.0')->rounded(),
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('mainCategory.name')->sortable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('size')->label('Size in Kg'),
                // Tables\Columns\TextColumn::make('description'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        $companyId = auth('stakeholder')->user()->company_id;
        return self::$model::where('company_id', $companyId)->orderBy('name', 'ASC');
    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\AttributesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
