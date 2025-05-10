<?php

namespace App\Filament\Resources\HolidaysResource\Pages;

use App\Filament\Resources\HolidaysResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHolidays extends CreateRecord
{
    protected static string $resource = HolidaysResource::class;
      //funcion para devolverme para la pagina de inicio
      protected function getRedirectUrl(): string
      {
          return $this->getResource()::getUrl('index');
      }
  
}
