<?php

namespace App\Filament\Personal\Widgets;

use App\Models\holiday;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class personalWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Pending Holidays', $this->getPendingHoliday(Auth::user())),
            Stat::make('Approved Holidays', $this->getApprovedgHoliday(Auth::user())),
            Stat::make('Average time on page', '3:12'),
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
}
