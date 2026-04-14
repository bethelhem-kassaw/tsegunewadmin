<?php

namespace App\Filament\Resources\TelegramOrderResource\Pages;

use App\Filament\Resources\TelegramOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTelegramOrder extends EditRecord
{
    protected static string $resource = TelegramOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
