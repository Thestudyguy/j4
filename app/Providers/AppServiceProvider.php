<?php

namespace App\Providers;

use App\Models\Inventory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('layouts.dashboard-navbar', function ($view) {

            /* ---------------------------------------------------------
             * INVENTORY NOTIFICATIONS
             * --------------------------------------------------------- */
            $inventoryItems = Inventory::all();
            $inventoryNotifications = [];
            $today = Carbon::today();
            $nearExpiryDays = 7;

            foreach ($inventoryItems as $item) {
                $expDate = Carbon::parse($item->expiration_date);

                /* --- 1. Expired --- */
                if ($expDate->isPast()) {
                    $inventoryNotifications[] = [
                        'type'      => 'expired',
                        'message'   => "{$item->item_name} has expired!",
                        'highlight' => 'bg-danger text-white'
                    ];
                }

                /* --- 2. Near Expiry --- */
                elseif ($expDate->diffInDays($today) <= $nearExpiryDays) {
                    $inventoryNotifications[] = [
                        'type'      => 'near_expiry',
                        'message'   => "{$item->item_name} is nearing expiry ({$expDate->format('M d, Y')})",
                        'highlight' => 'bg-warning text-dark'
                    ];
                }

                /* --- LOW STOCK & OUT OF STOCK BASED ON THRESHOLD --- */
                $threshold = $item->threshold ?? 0;
                $lowStockLimit = $threshold > 0 ? ceil($threshold * 0.10) : 10;

                // Out of stock
                if ($item->on_hand == 0) {
                    $inventoryNotifications[] = [
                        'type'      => 'out_of_stock',
                        'message'   => "{$item->item_name} is out of stock!",
                        'highlight' => 'bg-danger text-white'
                    ];
                }

                // Low stock (10% logic)
                elseif ($item->on_hand <= $lowStockLimit) {
                    $inventoryNotifications[] = [
                        'type'      => 'low_stock',
                        'message'   => "{$item->item_name} is low on stock (Only {$item->on_hand} left — below threshold)",
                        'highlight' => 'bg-warning text-dark'
                    ];
                }
            }

            /* ---------------------------------------------------------
             * APPOINTMENT NOTIFICATIONS
             * --------------------------------------------------------- */
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

            // Count appointments created today
            $madeTodayCount = $appointmentsNotif->filter(function ($appt) use ($today) {
                return !empty($appt->appointment_created) &&
                    Carbon::parse($appt->appointment_created)->isToday();
            })->count();

            // Count appointments due today
            $dueTodayCount = $appointmentsNotif->filter(function ($appt) use ($today) {
                return Carbon::parse($appt->date)->isToday();
            })->count();

            /* ---------------------------------------------------------
             * TOTAL NOTIFICATIONS
             * --------------------------------------------------------- */
            $totalNotif = $madeTodayCount + $dueTodayCount + count($inventoryNotifications);

            /* ---------------------------------------------------------
             * SEND TO NAVBAR
             * --------------------------------------------------------- */
            $view->with([
                'appointmentsNotif'      => $appointmentsNotif,
                'inventoryNotifications' => $inventoryNotifications,
                'madeTodayCount'         => $madeTodayCount,
                'dueTodayCount'          => $dueTodayCount,
                'totalNotif'             => $totalNotif
            ]);
        });
    }
}
