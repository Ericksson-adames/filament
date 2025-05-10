<?php

namespace App\Filament\Resources\TimessheetsResource\Pages;

use App\Filament\Resources\TimessheetsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimessheets extends EditRecord
{
    protected static string $resource = TimessheetsResource::class;
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
