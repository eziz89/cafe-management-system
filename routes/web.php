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
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $categories = Category::withCount('dishes')->get();
    
    $featuredDishes = Dish::withAvg('ratings', 'rating')->withCount('ratings')->where('status', 'available')->orderByDesc('ratings_avg_rating')->take(3)->get();

    return view('home', compact('featuredDishes', 'categories'));
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->middleware('auth')->name('reservations.my');
Route::get('/reservations/{reservation}/status', [ReservationController::class, 'status'])->middleware('auth')->name('reservations.status');
Route::get('/reservations/success/{reservation}', [ReservationController::class, 'success'])->name('reservations.success');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); 
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
});

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/count', [CartController::class, 'count']);

Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success/{order}', function (Order $order) {
    return view('checkout.success', compact('order'));
})->name('checkout.success');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::get('/my-orders', [OrderController::class, 'myOrders'])->middleware('auth')->name('orders.my');
Route::get('/my-orders/statuses', [OrderController::class, 'statuses'])->middleware('auth')->name('orders.statuses');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth')->name('orders.show');
Route::post('/orders/{order}/reorder', [OrderController::class, 'reorder'])->middleware('auth')->name('orders.reorder');
Route::get('/orders/{order}/status', [OrderController::class, 'status'])->middleware('auth')->name('orders.status');

Route::middleware('auth')->group(function () {
    Route::post('/dish/{id}/rate', [DishController::class, 'rate'])->name('dishes.rate');
    Route::post('/dish/{id}/comment', [DishController::class, 'comment'])->name('dishes.comment');
});

Route::post('/dishes/{id}/review', [DishController::class, 'review'])->middleware('auth')->name('dishes.review');

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

Route::post('/favorites/{dish}', [FavoriteController::class, 'toggle'])->middleware('auth')->name('favorites.toggle');
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth')->name('favorites.index');

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

Route::middleware('auth')->group(function () {
    Route::get('/notifications/poll', [NotificationController::class, 'poll'])->name('notifications.poll');
});