<?php

namespace App\Filament\Resources\PaymentConfigurationResource\Pages;

use App\Filament\Resources\PaymentConfigurationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentConfiguration extends CreateRecord
{
    protected static string $resource = PaymentConfigurationResource::class;
}
