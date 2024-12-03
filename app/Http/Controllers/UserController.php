<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Concession;


class UserController extends Controller
{
    public function dashboard()
    {

        // return view('dashboard');

        $orders = Order::all();
        return view('dashboard', compact('orders'));
    }

    public function index()
{
    $concessions = Concession::all(); // Fetch all concessions from the database
    return view('user.welcome', compact('concessions')); // Pass concessions to the view
}


}
