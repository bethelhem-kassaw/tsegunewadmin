<?php

namespace App\Filament\Resources\TelegramOrderResource\Pages;

use App\Filament\Resources\TelegramOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTelegramOrder extends CreateRecord
{
    protected static string $resource = TelegramOrderResource::class;
}
