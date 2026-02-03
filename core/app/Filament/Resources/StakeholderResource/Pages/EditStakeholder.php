<?php

namespace App\Filament\Resources\StakeholderResource\Pages;

use App\Filament\Resources\StakeholderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStakeholder extends EditRecord
{
    protected static string $resource = StakeholderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
