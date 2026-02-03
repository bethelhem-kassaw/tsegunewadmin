<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Country;
use App\Models\CountryCity;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use GeoIp2\Model\City;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippmentAdressRelationManager extends RelationManager
{
    protected static string $relationship = 'shippmentAdress';

    protected static ?string $recordTitleAttribute = 'fullname';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname'),
                TextInput::make('email'),
                Select::make('country_id')->options(fn () => Country::pluck('name', 'id')),
                // TextInput::make('postal_code'),
                TextInput::make('phone'),
                select::make('city_id')->name('city')->options(fn () => CountryCity::pluck('name', 'id')),
                // TextInput::make('posta_number'),
                TextInput::make('addressLine1'),
                TextInput::make('unit_number'),
                TextInput::make('buzz_number'),
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
                Tables\Columns\TextColumn::make('fullname'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('country.name')->label('Country'),
                // Tables\Columns\TextColumn::make('postal_code'),
                Tables\Columns\TextColumn::make('city.name'),
                // Tables\Columns\TextColumn::make('posta_number'),
                Tables\Columns\TextColumn::make('addressLine1'),
                Tables\Columns\TextColumn::make('unit_number'),
                Tables\Columns\TextColumn::make('buzz_number'),
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
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
