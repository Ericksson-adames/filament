<?php

namespace App\Filament\Resources\TimessheetsResource\Pages;

use App\Filament\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimessheets extends ListRecords
{
    protected static string $resource = TimessheetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
