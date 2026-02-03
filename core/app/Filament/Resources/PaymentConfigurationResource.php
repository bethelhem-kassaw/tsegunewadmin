<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentConfigurationResource\Pages;
use App\Filament\Resources\PaymentConfigurationResource\RelationManagers;
use App\Models\PaymentConfiguration;
use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentConfigurationResource extends Resource
{
    protected static ?string $model = PaymentConfiguration::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([ 
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('payment_method_id')->label('Payment method')->options(
                        PaymentMethod::where('status', 1)->pluck('name', 'id'))->reactive()->required(),
                        
                    Forms\Components\Repeater::make('field_values')->schema(function(callable $get){
                        $fieldId = $get('payment_method_id')?$get('payment_method_id'):[];
                        $form = [];
                        if($fieldId){
                            $fieldsNames = PaymentMethod::where('id', $fieldId)->first();
                            $fieldsNames = $fieldsNames?$fieldsNames->fields:[];
                            foreach($fieldsNames as $field){
                                $theForm = Forms\Components\TextInput::make($field['field_name'])->label($field['field_label'])->required();
                                array_push($form, $theForm);
                            }
                        }
                        return $form;
                    })->disableItemCreation()->hidden(function(callable $get){
                        $fieldId = $get('payment_method_id');
                        if( $fieldId){
                            $fieldsNames = PaymentMethod::where('id', $fieldId)->first()->fields;
                            if(count($fieldsNames)) return false;
                        }
                        return true;
                    })->disableItemDeletion(),
                    Forms\Components\Toggle::make('status'),
                    Forms\Components\Hidden::make('sell_provider_id')->default(auth('stakeholder')->user()->company_id)
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
                Tables\Columns\TextColumn::make('paymentMethod.name'),
                Tables\Columns\ToggleColumn::make('status'),
                Tables\Columns\TextColumn::make('updated_at')->view('filament.tables.columns.time')->label('Last update'),
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
            'index' => Pages\ListPaymentConfigurations::route('/'),
            'create' => Pages\CreatePaymentConfiguration::route('/create'),
            'edit' => Pages\EditPaymentConfiguration::route('/{record}/edit'),
        ];
    }    
}
