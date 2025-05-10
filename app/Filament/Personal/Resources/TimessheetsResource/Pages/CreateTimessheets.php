<?php

namespace App\Filament\Personal\Resources\TimessheetsResource\Pages;

use App\Filament\Personal\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTimessheets extends CreateRecord
{
    protected static string $resource = TimessheetsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = Auth::user()->id;
  

    return $data;
}
}
