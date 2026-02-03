<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuponResource\Pages;
use App\Filament\Resources\CuponResource\RelationManagers;
use App\Models\Cupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CuponResource extends Resource
{
    protected static ?string $model = Cupon::class;
    protected static ?string $navigationGroup = 'Extras';
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('code')->required(),
                    Forms\Components\TextInput::make('discount')->required()->numeric(),
                    Forms\Components\Select::make('type')
                                            ->options(['fixed' => 'Fixed', 'percent' => 'Percent'])
                                            ->label('Discount type')
                                            ->required(),
                    Forms\Components\TextInput::make('givento_name'),
                    Forms\Components\TextInput::make('givento_phone')->required(),
                    Forms\Components\DateTimePicker::make('expire_at')
                                                ->required()
                                                ->minDate(now()),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('count'),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('givento_name'),
                Tables\Columns\TextColumn::make('givento_phone'),
                Tables\Columns\TextColumn::make('expire_at'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function canViewAny(): bool
    {

        if (auth('stakeholder')->check()) {
            $user = auth('stakeholder')->user();
            return auth('stakeholder')->user()->hasRole('super-admin');
        } else {
         return dd(Auth::user());
        }

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
            'index' => Pages\ListCupons::route('/'),
            'create' => Pages\CreateCupon::route('/create'),
            'edit' => Pages\EditCupon::route('/{record}/edit'),
        ];
    }
}
