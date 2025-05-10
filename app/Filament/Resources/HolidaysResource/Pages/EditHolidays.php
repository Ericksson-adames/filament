<?php

namespace App\Filament\Resources\HolidaysResource\Pages;

use App\Filament\Resources\HolidaysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHolidays extends EditRecord
{
    protected static string $resource = HolidaysResource::class;
      //funcion para devolverme para la pagina de inicio
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
