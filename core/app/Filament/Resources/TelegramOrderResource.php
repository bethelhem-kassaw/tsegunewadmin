<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TelegramOrderResource\Pages;
use App\Filament\Resources\TelegramOrderResource\RelationManagers;
use App\Models\TelegramOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TelegramOrderResource extends Resource
{
    protected static ?string $model = TelegramOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Info')
                    ->schema([
                        Forms\Components\TextInput::make('telegram_id')->disabled(),
                        Forms\Components\TextInput::make('telegram_username')->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Order Details')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')->disabled(),
                        Forms\Components\TextInput::make('total_price')->prefix('ETB')->disabled(),

                        // This displays the JSON measurements as a list in Admin
                        Forms\Components\KeyValue::make('measurements')
                            ->label('Custom Sizes (cm)')
                            ->keyLabel('Body Part')
                            ->valueLabel('Size')
                            ->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('telegram_id')->label('User ID')->copyable(),
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('clothing_category')
                    ->colors([
                        'primary' => 'women',
                        'success' => 'men',
                        'warning' => 'children',
                    ]),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListTelegramOrders::route('/'),
            'create' => Pages\CreateTelegramOrder::route('/create'),
            'edit' => Pages\EditTelegramOrder::route('/{record}/edit'),
        ];
    }
}
