<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConcessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Public Routes
Route::get('/', [UserController::class, 'index'])->name('index');

// Protected Routes (Authenticated Users Only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Concessions
    Route::prefix('concessions')->group(function () {
        Route::get('/', [ConcessionController::class, 'index'])->name('concessions.index');
        Route::get('/create', [ConcessionController::class, 'create'])->name('concessions.create');
        Route::post('/', [ConcessionController::class, 'store'])->name('concessions.store');
        Route::get('/{concession}/edit', [ConcessionController::class, 'edit'])->name('concessions.edit');
        Route::put('/{concession}', [ConcessionController::class, 'update'])->name('concessions.update');
        Route::delete('/{concession}', [ConcessionController::class, 'destroy'])->name('concessions.destroy');
    });

    // Orders
    Route::resource('orders', OrderController::class);
    Route::get('orders/{id}/send-to-kitchen', [OrderController::class, 'sendToKitchen'])->name('orders.sendToKitchen');

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    });

    // Kitchen
    Route::prefix('kitchen')->name('kitchen.')->group(function () {
        Route::get('/', [KitchenController::class, 'index'])->name('index');
        Route::get('/status/{id}', [KitchenController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/send-to-kitchen/{orderId}', [KitchenController::class, 'queueOrderToKitchen'])->name('sendToKitchen');
        Route::put('{id}/update-status', [KitchenController::class, 'updateStatus'])->name('updateStatus');
    });
});
