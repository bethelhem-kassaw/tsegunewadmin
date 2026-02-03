<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentRelationManager extends RelationManager
{
    protected static string $relationship = 'payment';

    protected static ?string $recordTitleAttribute = 'payment_method';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('payment_id')->label('Transaction')->readOnly(),
                TextInput::make('payment_method')->readOnly(),
                TextInput::make('currency')->readOnly(),
                TextInput::make('amount')->label('Amount')->readOnly(),
                // Tables\Columns\TextColumn::make('tax'),
                // Tables\Columns\TextColumn::make('vat'),
                // Tables\Columns\TextColumn::make('price'),
                // Tables\Columns\SelectColumn::make('status')->options(['approved' => 'Approved', 'cancelled' => 'Cancelled', 'completed' => 'Completed', 'refunded' => 'Refunded']),
                TextInput::make('payer_email')->readOnly(),
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
                Tables\Columns\TextColumn::make('payment_id')->label('Transaction'),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\TextColumn::make('amount')->label('Amount'),
                // Tables\Columns\TextColumn::make('tax'),
                // Tables\Columns\TextColumn::make('vat'),
                // Tables\Columns\TextColumn::make('price'),
                // Tables\Columns\SelectColumn::make('status')->options(['approved' => 'Approved', 'cancelled' => 'Cancelled', 'completed' => 'Completed', 'refunded' => 'Refunded']),
                Tables\Columns\TextColumn::make('payer_email'),
            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
