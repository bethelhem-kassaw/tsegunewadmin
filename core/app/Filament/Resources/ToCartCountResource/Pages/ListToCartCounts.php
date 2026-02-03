<?php

namespace App\Filament\Resources\ToCartCountResource\Pages;

use App\Filament\Resources\ToCartCountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListToCartCounts extends ListRecords
{
    protected static string $resource = ToCartCountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
