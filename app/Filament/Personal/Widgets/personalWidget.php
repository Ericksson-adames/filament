<?php

namespace App\Filament\Personal\Widgets;

use App\Models\holiday;
use App\Models\timessheets;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class personalWidget extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            // definiendo los datos que se mostrarán en el widget
            Stat::make('Pending Holidays', $this->getPendingHoliday(Auth::user())),
            Stat::make('Approved Holidays', $this->getApprovedgHoliday(Auth::user())),
            Stat::make('Horas Trabajadas', $this->getTotalWork(Auth::user())),
        ];
    }
    //funcion para obtener el numero de vacaciones pendientes
    protected function getPendingHoliday(User $user){

        $totalHolidayPending = holiday::where('user_id', $user->id)
        ->where('type','pending')->get()->count();

        return $totalHolidayPending;

    }
    //funcion para obtener el numero de vacaciones aprobadas
    protected function getApprovedgHoliday(User $user){

        $totalHolidayApproved = holiday::where('user_id', $user->id)
        ->where('type','approved')->get()->count();

        return $totalHolidayApproved;

    }
    //funcion para calcular el tiempo promedio de las horas trabajadas
    protected function getTotalWork(User $user){
        $timesheet = timessheets::where('user_id', $user->id)
            ->where('type','work')->whereDate('created_at', Carbon::today())->get();
        $sumSeconds = 0;
        foreach ($timesheet as $timesheets) {
            # code...
            $startTime = Carbon::parse($timesheets->day_in);
            $finishTime = Carbon::parse($timesheets->day_out);

            $totalDuration = $finishTime->diffInSeconds($startTime);
            $sumSeconds = $sumSeconds + $totalDuration;

        }
        $tiempoFormato = gmdate("H:i:s", $sumSeconds);

        return $tiempoFormato;

    }
}
