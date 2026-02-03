<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Resources\OrderdetailsResource;
use App\Models\Attribute;
use App\Models\OrderDetail;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderDetails';

    protected static ?string $recordTitleAttribute = 'product.name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('product_id')->options(Product::all()->pluck('name', 'id'))->label('Product')->required()->searchable(),
                // FileUpload::make('products.photos.0'),
                // ViewField::make('products.photos.0')->label('Product Name'),
                // TextInput::make('product.name'),
                // TextInput::make('quantity'),
                // FileUpload::make('path'),
                // TextInput::make('price'),
                // TextInput::make('specifications'),


                                        ]);
    }
    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product.photos.0')->url(fn (OrderDetail $record) => OrderdetailsResource::getUrl('edit', ['record' => $record->id]))->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('product.name')->url(fn (OrderDetail $record) => OrderdetailsResource::getUrl('edit', ['record' => $record->id]))->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('quantity'),
                // TextColumn::make('text_details'),
                // ImageColumn::make('path'),
                // Tables\Columns\TextColumn::make(''),
                Tables\Columns\TextColumn::make('delivery_date'),
                TextColumn::make('delivery_time'),

                Tables\Columns\TagsColumn::make('specifications')->separator(',')->getStateUsing(
                    function (OrderDetail $record) {

                        $attributes = $record->specifications;
                        // dd($attributes);


                         // Loop through the attributes and replace attribute_id with attribute_name
if (!empty($attributes['attribute_id'])) {
            $attributeModel = Attribute::find($attributes['attribute_id']);
            if ($attributeModel) {
                $attribute['attribute_name'] = $attributeModel->name;
                $attribute['values'] = $attributes['values']; // You can rename 'values' to 'value' here if preferred
                unset($attribute['attribute_id']); // Optionally remove attribute_id
                unset($attribute['value']); // Optionally remove values if no longer needed
            } else {
                $attribute['attribute_name'] = 'Unknown Attribute';
                $attribute['value'] = $attribute['value']; // Keep the value as is
                unset($attribute['value']); // Optionally remov
            }

                        return collect($attribute)

                        ->implode(', ');
        }

                    }
                ),
            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
