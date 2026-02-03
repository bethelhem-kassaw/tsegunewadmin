<?php

namespace App\Filament\Resources\OrderdetailsResource\Pages;

use App\Filament\Resources\OrderdetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderdetails extends EditRecord
{
    protected static string $resource = OrderdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
