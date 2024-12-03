<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SendOrderToKitchen;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        // Fetch all orders with "Pending" status
        $pendingOrders = \App\Models\Order::where('status', 'Pending')->get();

        foreach ($pendingOrders as $order) {
            // Update their status to "In-Progress"
            $order->update(['status' => 'In-Progress']);
        }
    })->everyMinute(); // Run every minute (you can adjust this frequency)
}

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
