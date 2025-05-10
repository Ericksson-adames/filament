<?php

namespace App\Filament\Resources\DepartamentResource\Pages;

use App\Filament\Resources\DepartamentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDepartament extends CreateRecord
{
    protected static string $resource = DepartamentResource::class;
      //funcion para devolverme para la pagina de inicio
      protected function getRedirectUrl(): string
      {
          return $this->getResource()::getUrl('index');
      }
  
}
