<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StakeholderResource\Pages;
use App\Filament\Resources\StakeholderResource\RelationManagers;
use App\Models\Role;
use App\Models\SellProvider;
use App\Models\Stakeholder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StakeholderResource extends Resource
{
    protected static ?string $model = Stakeholder::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User & Roles';

    public static function getGloballySearchableAttributes():array{
        return ['first_name', 'last_name', 'email'];
     }

    public static function form(Form $form): Form
    {
        $isAdmin = auth('stakeholder')->user()->hasRole('admin');

        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('first_name'),
                    Forms\Components\TextInput::make('last_name'),
                    Forms\Components\TextInput::make('email'),
                    Forms\Components\TextInput::make('phone'),
                   
                    Forms\Components\CheckboxList::make('roles')->relationship('roles', 'slug', function($query){
                        $query->whereNotIn('slug',['super-admin']);
                    })->columns(2),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_path')->label('Photo'),
                Tables\Columns\TextColumn::make('first_name')->sortable(),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\BadgeColumn::make('worksFor.provider_name')->hidden(!auth('stakeholder')->user()->hasRole('super-admin')),
                Tables\Columns\TagsColumn::make('roles.name')->label('Role'),
                Tables\Columns\TextColumn::make('email')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\RolesRelationManager::class,
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $isSuperAdmin = auth()->user('stakeholder')->hasRole('super-admin');

        if($isSuperAdmin){
            return self::$model::whereDoesntHave('roles', function ($query){
                return $query->whereIn('slug', ['super-admin']);
            });
        }

        return self::$model::where('company_id', auth('stakeholder')->user()->company_id)->whereDoesntHave('roles', function ($query){
            return  $query->whereIn('slug', ['super-admin', 'admin']);
        });
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStakeholders::route('/'),
            'create' => Pages\CreateStakeholder::route('/create'),
            'edit' => Pages\EditStakeholder::route('/{record}/edit'),
        ];
    }
}
