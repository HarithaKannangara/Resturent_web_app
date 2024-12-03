<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Concession;
use Illuminate\Http\Request;

class KitchenController extends Controller
{

    public function index()
{
    // Fetch orders with 'In-Progress' status
    $orders = Order::where('status', 'In-Progress')->get();

    $orders->map(function ($order) {
        // Decode selected_concessions and quantities
        $selectedConcessions = $order->selected_concessions ?? [];
        $quantities = $order->quantities ?? [];

        // Debugging: Check if concessions and quantities are properly decoded
        // Uncomment the line below to inspect data
        // dd($selectedConcessions, $quantities);

        // Retrieve concessions associated with the order
        $concessions = Concession::whereIn('id', $selectedConcessions)->get();

        // Map concessions with their quantities
        $order->concessions = $concessions->map(function ($concession) use ($quantities) {
            return [
                'id' => $concession->id,
                'name' => $concession->name,
                'quantity' => $quantities[$concession->id] ?? 0, // Default to 0 if not found
            ];
        });

        return $order;

    });


    return view('kitchen.index', compact('orders'));
}





    public function updateStatus($id)
    {
        // Find the order and update its status to 'Completed'
        $order = Order::findOrFail($id);
        $order->status = 'Completed';
        $order->save();

        return redirect()->route('kitchen.index')->with('success', 'Order marked as completed.');
    }
}
