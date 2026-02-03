<?php

namespace App\Filament\Resources\OrderdetailsResource\Pages;

use App\Filament\Resources\OrderdetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderdetails extends ListRecords
{
    protected static string $resource = OrderdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
