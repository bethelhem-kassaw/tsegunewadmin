<?php

namespace App\Filament\Resources\ToCartCountResource\Pages;

use App\Filament\Resources\ToCartCountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditToCartCount extends EditRecord
{
    protected static string $resource = ToCartCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
