<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReservationController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dishes', [DishController::class, 'index'])->name('dishes.index');
    Route::get('/dishes', [DishController::class, 'index']);
    Route::get('/dishes/create', [DishController::class, 'create']);
    Route::post('/dishes', [DishController::class, 'store']);
    Route::get('/dishes/{id}/edit', [DishController::class, 'edit']);
    Route::put('/dishes/{id}', [DishController::class, 'update']);
    Route::delete('/dishes/{id}', [DishController::class, 'destroy']);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);
    Route::get('/admin/categories', function () {
        return view('admin.categories.index');
    });
});