<?php

namespace App\Filament\Resources\ShippmentMethodResource\Pages;

use App\Filament\Resources\ShippmentMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippmentMethods extends ListRecords
{
    protected static string $resource = ShippmentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
