<?php

namespace App\Filament\Resources\TimessheetsResource\Pages;

use App\Filament\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTimessheets extends CreateRecord
{
    protected static string $resource = TimessheetsResource::class;
      //funcion para devolverme para la pagina de inicio
      protected function getRedirectUrl(): string
      {
          return $this->getResource()::getUrl('index');
      }
  
}
