<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderdetailsResource\Pages;
use App\Filament\Resources\OrderdetailsResource\RelationManagers;
use App\Models\OrderDetail;
use App\Models\Orderdetails;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderdetailsResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders';
    protected static $title = 'Order Detail';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')->options(Product::all()->pluck('name', 'id'))->label('Product')->required()->searchable(),
                // FileUpload::make('products.photos.0'),
            //    Placeholder::make('products.photos.0')->label('Product name')->content(fn ($record) => $record->product && $record->product->photos
            //    ?  $record->product->name
            //    : 'No image available'),

                // TextInput::make('product.name'),
                TextInput::make('quantity'),

                // TextInput::make('price'),
                TextInput::make('text_details'),

                TextInput::make('specifications'),
                FileUpload::make('path')->image()->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product.photos.0'),
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('quantity'),
                TextColumn::make('text_details'),
                ImageColumn::make('path'),
                // Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TagsColumn::make('specifications')->separator(','),
            ]) ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderdetails::route('/'),
            'create' => Pages\CreateOrderdetails::route('/create'),
            'edit' => Pages\EditOrderdetails::route('/{record}/edit'),
        ];
    }
}
