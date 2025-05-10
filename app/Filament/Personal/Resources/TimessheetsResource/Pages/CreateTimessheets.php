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
   //funcion para que automaticamente se agregue el usuario que esta logueado
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = Auth::user()->id;
  

    return $data;
}
}
