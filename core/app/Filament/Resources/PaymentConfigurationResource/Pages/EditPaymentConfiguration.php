<?php

namespace App\Filament\Resources\PaymentConfigurationResource\Pages;

use App\Filament\Resources\PaymentConfigurationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentConfiguration extends EditRecord
{
    protected static string $resource = PaymentConfigurationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
