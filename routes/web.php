<?php

use Illuminate\Support\Facades\Route;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Category;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DishController as AdminDishController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/', function () {
    $categories = Category::take(3)->get();
    
    $featuredDishes = Dish::latest()->take(3)->get();

    return view('home', compact('featuredDishes', 'categories'));
});

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dishes', [DishController::class, 'index']);
    Route::get('/admin/dishes/create', [DishController::class, 'create']);
    Route::post('/admin/dishes', [DishController::class, 'store']);
    Route::get('/admin/dishes/{id}/edit', [DishController::class, 'edit']);
    Route::put('/admin/dishes/{id}', [DishController::class, 'update']);
    Route::delete('/admin/dishes/{id}', [DishController::class, 'destroy']);
});

Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/admin/reservations', [ReservationController::class, 'index'])->middleware('auth');
Route::patch('/admin/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->middleware('auth');
Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->middleware('auth')->name('reservations.my');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); 
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/checkout/success', function () {
    return view('checkout.success');
})->name('checkout.success');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('auth');

Route::get('/admin/categories', function () {
    return view('admin.categories.index');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/orders', [AdminOrderController::class, 'index'])->middleware('auth')->name('admin.orders');
Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->middleware('auth')->name('orders.my');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth')->name('orders.show');
Route::post('/orders/{order}/reorder', [OrderController::class, 'reorder'])->middleware('auth')->name('orders.reorder');

Route::middleware('auth')->group(function () {
    Route::post('/dish/{id}/rate', [DishController::class, 'rate'])->name('dishes.rate');
    Route::post('/dish/{id}/comment', [DishController::class, 'comment'])->name('dishes.comment');
});

Route::post('/dishes/{id}/review', [DishController::class, 'review'])->name('dishes.review');