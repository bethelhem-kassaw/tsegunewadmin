<?php

namespace App\Filament\Resources\TelegramOrderResource\Pages;

use App\Filament\Resources\TelegramOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTelegramOrders extends ListRecords
{
    protected static string $resource = TelegramOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
