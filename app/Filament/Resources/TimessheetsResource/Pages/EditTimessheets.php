<?php

namespace App\Filament\Resources\TimessheetsResource\Pages;

use App\Filament\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimessheets extends EditRecord
{
    protected static string $resource = TimessheetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
