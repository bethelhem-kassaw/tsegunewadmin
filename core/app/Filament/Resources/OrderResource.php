<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Orders';
    public static function getNavigationBadge(): ?string
    {
        return Order::where('status', 'pending')->count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('status')
                                            ->options(['approved' => 'Approved', 'cancelled' => 'Cancelled', 'completed' => 'Completed', 'refunded' => 'Refunded'])->afterStateUpdated(function ($record, $state) {


                                                // Ensure the record has a user and send notification
                                                if ($record->email) {
                                                    $record->notify(new OrderStatusNotification($state, $record));
                                                }
                                            })
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('orderId')->sortable()->searchable(),

                TextColumn::make('name')->sortable()->searchable(),
                // Tables\Columns\TextColumn::make('traking_id'),
                Tables\Columns\SelectColumn::make('status')->options(['approved' => 'Approved', 'cancelled' => 'Cancelled', 'completed' => 'Completed', 'refunded' => 'Refunded'])->afterStateUpdated(function ($record, $state) {


                    // Ensure the record has a user and send notification
                    if ($record->email) {
                        $record->notify(new OrderStatusNotification($state, $record));
                    }
                }),


                Tables\Columns\TextColumn::make('created_at')->label('Ordered at')->sortable(),


                Tables\Columns\TextColumn::make('payment_id'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return self::$model::orderBy('created_at', 'DESC');
    }
    public static function canCreate():bool {return false;}
    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderDetailsRelationManager::class,
            RelationManagers\PaymentRelationManager::class,
            RelationManagers\ShippmentAdressRelationManager::class,
        ];
    }
    // protected function canCreate(): bool { return false; }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
