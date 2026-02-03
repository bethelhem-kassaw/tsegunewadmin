<?php

namespace App\Filament\Resources\SellProviderResource\Pages;

use App\Filament\Resources\SellProviderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSellProviders extends ListRecords
{
    protected static string $resource = SellProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
