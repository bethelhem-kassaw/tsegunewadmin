<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToCartCountResource\Pages;
use App\Filament\Resources\ToCartCountResource\RelationManagers;
use App\Models\ToCartCount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ToCartCountResource extends Resource
{
    protected static ?string $model = ToCartCount::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
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
                Tables\Columns\TextColumn::make('product.name')->sortable(),
                Tables\Columns\TextColumn::make('ip_adress')->label('From'),
                Tables\Columns\TextColumn::make('count_per_day')->label('Count')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('At')->view('filament.tables.columns.time')->sortable(),
            ])
            ->filters([
                // Tables\Filters\Filter::make('created_at')
                // ->form([
                //     Forms\Components\DatePicker::make('created_from'),
                //     Forms\Components\DatePicker::make('created_until'),
                // ])
                // ->query(function (Builder $query, array $data): Builder {
                //     return $query
                //         ->when(
                //             $data['created_from'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //         )
                //         ->when(
                //             $data['created_until'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //         );
                // })
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
        return self::$model::orderBy('created_at', 'desc');
    }
    public static function canCreate(): bool
    {
        return false;
    }
    public static function canEdit(Model $record): bool
    {
        return false;
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
            'index' => Pages\ListToCartCounts::route('/'),
            'create' => Pages\CreateToCartCount::route('/create'),
            'edit' => Pages\EditToCartCount::route('/{record}/edit'),
        ];
    }    
}
