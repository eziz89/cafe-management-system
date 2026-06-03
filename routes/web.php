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
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $categories = Category::withCount('dishes')->take(4)->get();
    
    $featuredDishes = Dish::latest()->take(3)->get();

    return view('home', compact('featuredDishes', 'categories'));
});

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->middleware('auth')->name('reservations.my');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); 
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
});

Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/checkout/success', function () {
    return view('checkout.success');
})->name('checkout.success');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/my-orders', [OrderController::class, 'myOrders'])->middleware('auth')->name('orders.my');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth')->name('orders.show');
Route::post('/orders/{order}/reorder', [OrderController::class, 'reorder'])->middleware('auth')->name('orders.reorder');

Route::middleware('auth')->group(function () {
    Route::post('/dish/{id}/rate', [DishController::class, 'rate'])->name('dishes.rate');
    Route::post('/dish/{id}/comment', [DishController::class, 'comment'])->name('dishes.comment');
});

Route::post('/dishes/{id}/review', [DishController::class, 'review'])->name('dishes.review');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

Route::get('/language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ru', 'tk'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    return back();
})->name('language.switch');