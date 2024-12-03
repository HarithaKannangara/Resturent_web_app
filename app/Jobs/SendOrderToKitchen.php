<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Kitchen;

class SendOrderToKitchen extends Job
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $totalCost = 0;
        foreach (json_decode($this->order->selected_concessions) as $concessionId) {
            $concession = Concession::find($concessionId);
            $totalCost += $concession->price;
        }

        Kitchen::create([
            'order_id' => $this->order->id,
            'total_cost' => $totalCost,
            'status' => 'In-Progress',
        ]);

        // Update order status to 'In-Progress'
        $this->order->status = 'In-Progress';
        $this->order->save();
    }
}
