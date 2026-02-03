<?php

namespace App\Filament\Resources\SellProviderResource\Pages;

use App\Filament\Resources\SellProviderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellProvider extends EditRecord
{
    protected static string $resource = SellProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
