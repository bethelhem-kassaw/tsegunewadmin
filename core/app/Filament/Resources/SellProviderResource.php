<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellProviderResource\Pages;
use App\Filament\Resources\SellProviderResource\RelationManagers;
use App\Models\SellProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SellProviderResource extends Resource
{
    protected static ?string $model = SellProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function canViewAny(): bool
    {
        return auth('stakeholder')->user()->hasRole('super-admin');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('provider_name')->required(),
                    Forms\Components\TextInput::make('provider_phone')->required(),
                    Forms\Components\TextInput::make('description'),
                    Forms\Components\TextInput::make('moto'),
                    Forms\Components\FileUpload::make('logo_url')->image(),
                    Forms\Components\FileUpload::make('license_url')->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats']),
                    Forms\Components\Toggle::make('status'),
                ])
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo_url'),
                Tables\Columns\TextColumn::make('provider_name')->sortable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('provider_phone'),
                Tables\Columns\TextColumn::make('moto'),
                Tables\Columns\ToggleColumn::make('status'),
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
        return self::$model::orderBy('provider_name', 'asc');
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
            'index' => Pages\ListSellProviders::route('/'),
            'create' => Pages\CreateSellProvider::route('/create'),
            'edit' => Pages\EditSellProvider::route('/{record}/edit'),
        ];
    }    
}
