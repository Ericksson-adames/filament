<?php

namespace App\Filament\Personal\Resources\TimessheetsResource\Pages;

use App\Filament\Personal\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimessheets extends EditRecord
{
    protected static string $resource = TimessheetsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
