<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Concession; // Assuming this model exists

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $concessions = Concession::all();
        return view('orders.create', compact('concessions'));
    }

    /**
     * Store a newly created order in the database.
     */
    public function store(Request $request)
{
    $request->validate([
        'selected_concessions' => 'required|array',
        'send_to_kitchen_time' => 'required|date',
        'quantities' => 'required|array',
        'quantities.*' => 'numeric|min:1', // Validate each quantity as numeric and at least 1
    ]);

    $data = [
        'selected_concessions' => $request->selected_concessions,
        'send_to_kitchen_time' => $request->send_to_kitchen_time,
        'status' => 'Pending', // Default status
        'quantities' => json_encode($request->quantities), // Encode as JSON
    ];
    Order::create($data);
    return redirect()->route('orders.index')->with('success', 'Order created successfully.');
}
    /**
     * Delete the specified order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Manually send an order to the kitchen.
     */
    public function sendToKitchen($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'Pending') {
            $order->update(['status' => 'In-Progress']);
        }

        return redirect()->route('orders.index')->with('success', 'Order sent to kitchen.');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $concessions = Concession::all(); // Get all concessions

        return view('orders.show', compact('order', 'concessions')); // Pass both order and concessions
    }

/**
 * Show the form for editing the specified order.
 */
public function edit($id)
{
    $order = Order::findOrFail($id);
    $concessions = Concession::all();
    return view('orders.edit', compact('order', 'concessions'));
}
}
