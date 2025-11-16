<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer('layouts.dashboard-navbar', function ($view) {

        $appointmentsNotif = DB::table('appointments')
            ->join('users', 'users.id', '=', 'appointments.patient_id')
            ->join('sub_services', 'sub_services.id', '=', 'appointments.service_id')
            ->select(
                'appointments.status',
                'appointments.date',
                'appointments.time',
                'users.FirstName',
                'sub_services.Service',
                'sub_services.Price',
                'appointments.created_at as appointment_created'
            )
            ->get();

        // Today's date
        $today = \Carbon\Carbon::today();

        // Count appointments "Made Today"
        $madeTodayCount = $appointmentsNotif->filter(function ($appt) use ($today) {
            return !empty($appt->appointment_created) &&
                   \Carbon\Carbon::parse($appt->appointment_created)->isToday();
        })->count();

        // Count appointments "Due Today"
        $dueTodayCount = $appointmentsNotif->filter(function ($appt) use ($today) {
            return \Carbon\Carbon::parse($appt->date)->isToday();
        })->count();

        // Total
        $totalNotif = $madeTodayCount + $dueTodayCount;

        // Pass to the navbar view
        $view->with([
            'appointmentsNotif' => $appointmentsNotif,
            'madeTodayCount'    => $madeTodayCount,
            'dueTodayCount'     => $dueTodayCount,
            'totalNotif'        => $totalNotif
        ]);
    });
}

}
