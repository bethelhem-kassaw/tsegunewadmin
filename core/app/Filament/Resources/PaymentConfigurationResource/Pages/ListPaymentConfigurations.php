<?php

namespace App\Filament\Resources\PaymentConfigurationResource\Pages;

use App\Filament\Resources\PaymentConfigurationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentConfigurations extends ListRecords
{
    protected static string $resource = PaymentConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
