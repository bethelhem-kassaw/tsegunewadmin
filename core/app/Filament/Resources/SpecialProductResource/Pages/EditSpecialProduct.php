<?php

namespace App\Filament\Resources\SpecialProductResource\Pages;

use App\Filament\Resources\SpecialProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpecialProduct extends EditRecord
{
    protected static string $resource = SpecialProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
