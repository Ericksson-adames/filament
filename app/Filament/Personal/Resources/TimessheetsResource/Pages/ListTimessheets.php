<?php

namespace App\Filament\Personal\Resources\TimessheetsResource\Pages;

use App\Filament\Personal\Resources\TimessheetsResource;
use App\Models\timessheets;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ListTimessheets extends ListRecords
{
    protected static string $resource = TimessheetsResource::class;

    protected function getHeaderActions(): array
    {
        //Obtienes el último registro de hoja de tiempo (timesheet) del usuario autenticado.
        $lastTimesheet = timessheets::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        return [
            //boton de accion para crear un nuevo registro de hoja de tiempo.
            Action::make('inWork')
            ->label('Entrada')
            ->color('success')
            ->requiresConfirmation()
            ->action(function (){
                $user = Auth::user();
                $timessheet = new timessheets();
                $timessheet->calendar_id = 1;
                $timessheet->user_id = $user->id;
                $timessheet->day_in = Carbon::now();
                $timessheet->type = 'work';
                $timessheet->save();   

            }),
           //boton de accion para crear una pausa en la hoja de tiempo.
            Action::make('inPause')
            ->label('pausa')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet){
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                $timessheet = new timessheets();
                $timessheet->calendar_id = 1;
                $timessheet->user_id = Auth::user()->id;
                $timessheet->day_in = Carbon::now();
                $timessheet->type = 'pause';
                $timessheet->save();

            }),
            //boton de accion para terminar la pausa en la hoja de tiempo.
            Action::make('stopause')
            ->label('Terminal pausa')
            ->color('warning')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet){
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                $timessheet = new timessheets();
                $timessheet->calendar_id = 1;
                $timessheet->user_id = Auth::user()->id;
                $timessheet->day_in = Carbon::now();
                $timessheet->type = 'work';
                $timessheet->save();

            }),
            //boton de accion para terminar la jornada de trabajo de la hoja de tiempo.
            Action::make('stopWork')
            ->label('Fin Dia')
            ->color('success')
            ->requiresConfirmation()
            ->action(function () use ($lastTimesheet){
                $lastTimesheet->day_out = Carbon::now();
                $lastTimesheet->save();
                
            }),

            Actions\CreateAction::make(),
        ];
    }
}
