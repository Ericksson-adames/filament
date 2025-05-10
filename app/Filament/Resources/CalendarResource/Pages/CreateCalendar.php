<?php

namespace App\Filament\Resources\CalendarResource\Pages;

use App\Filament\Resources\CalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCalendar extends CreateRecord
{
    protected static string $resource = CalendarResource::class;

      //funcion para devolverme para la pagina de inicio
      protected function getRedirectUrl(): string
      {
          return $this->getResource()::getUrl('index');
      }
  
}
