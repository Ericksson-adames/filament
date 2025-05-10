<?php

namespace App\Filament\Personal\Resources\TimessheetsResource\Pages;

use App\Filament\Personal\Resources\TimessheetsResource;
use Filament\Actions;
use app\Models\timessheets;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ListTimessheets extends ListRecords
{
    protected static string $resource = TimessheetsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('inWork')
            ->label('Entrar a trabajar')
            ->color('success')
            ->requiresConfirmation()
            ->action(function (){
                $user = Auth::user();
                $timessheet = new timessheets();
                $timessheet->calendar_id = 1;
                $timessheet->user_id = $user->id;
                $timessheet->day_in = Carbon::now();
                $timessheet->day_out = Carbon::now();
                $timessheet->type = 'work';
                $timessheet->save();

            }),
            Action::make('outWork')
            ->label('pausar trabajo')
            ->color('danger')
            ->requiresConfirmation()
            ->action(function (){
                $user = Auth::user();
                $timessheet = new timessheets();
                $timessheet->calendar_id = 1;
                $timessheet->user_id = $user->id;
                $timessheet->day_in = Carbon::now();
                $timessheet->day_out = Carbon::now();
                $timessheet->type = 'pause';
                $timessheet->save();

            }),

            Actions\CreateAction::make(),
        ];
    }
}
