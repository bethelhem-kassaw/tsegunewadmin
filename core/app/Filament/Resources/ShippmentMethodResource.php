<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippmentMethodResource\Pages;
use App\Models\ShippmentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ShippmentMethodResource extends Resource
{
    protected static ?string $model = ShippmentMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\TextInput::make('capability')->required(),
                    Forms\Components\TextInput::make('api_key')->required(),
                    Forms\Components\TextInput::make('api_secret')->required(),
                    Forms\Components\TextInput::make('final_access'),
                    Forms\Components\Toggle::make('status'),
                ])
            ]);
    }
    public static function canViewAny(): bool
    {
        return auth('stakeholder')->user()->hasRole('super-admin');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('capability'),
                Tables\Columns\ToggleColumn::make('status'),
                Tables\Columns\TextColumn::make('updated_at')->view('filament.tables.columns.time'),
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
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippmentMethods::route('/'),
            'create' => Pages\CreateShippmentMethod::route('/create'),
            'edit' => Pages\EditShippmentMethod::route('/{record}/edit'),
        ];
    }    
}
