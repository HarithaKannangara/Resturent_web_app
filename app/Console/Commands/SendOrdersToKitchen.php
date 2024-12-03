<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class SendOrdersToKitchen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:send-to-kitchen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update pending orders to in-progress';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pendingOrders = Order::where('status', 'Pending')->get();

        foreach ($pendingOrders as $order) {
            $order->update(['status' => 'In-Progress']);
        }

        $this->info('Pending orders have been sent to the kitchen.');
        return 0;
    }
}
