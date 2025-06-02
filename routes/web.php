<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminGameController;
use App\Http\Middleware\AdminMiddleware;

// Маршруты аутентификации (должны быть первыми)
Auth::routes();

// Главный маршрут с проверкой аутентификации
Route::get('/', function () {
    return auth()->check() ? redirect('/home') : view('auth.login');
})->name('root'); // Переименовал имя маршрута, чтобы не конфликтовать с 'login'

// Защищенные маршруты
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/security', [App\Http\Controllers\ProfileController::class, 'security'])->name('profile.security');
    Route::put('/profile/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Магазин игр
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{game}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');

// Корзина
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{game}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.remove');

    // Заказы
    Route::post('/order/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');

    // Библиотека
    Route::get('/library', [App\Http\Controllers\LibraryController::class, 'index'])->name('library.index');
});

Route::get('/library/{game}', [App\Http\Controllers\LibraryController::class, 'show'])->name('library.show');
// Библиотека
Route::get('/library', [App\Http\Controllers\LibraryController::class, 'index'])->name('library.index');
Route::get('/library/game/{game}', [App\Http\Controllers\LibraryController::class, 'show'])->name('library.show');

Route::middleware(['auth'])->group(function () {
    // ... другие маршруты ...
    Route::get('/balance/topup', [App\Http\Controllers\BalanceController::class, 'showTopupForm'])->name('balance.topup');
    Route::post('/balance/topup', [App\Http\Controllers\BalanceController::class, 'topup'])->name('balance.topup.submit');
});

// Админ-роуты
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/games', [App\Http\Controllers\AdminGameController::class, 'index'])->name('admin.games.index');
    Route::get('/games/create', [App\Http\Controllers\AdminGameController::class, 'create'])->name('admin.games.create');
    Route::post('/games', [App\Http\Controllers\AdminGameController::class, 'store'])->name('admin.games.store');
    Route::get('/games/{game}/edit', [App\Http\Controllers\AdminGameController::class, 'edit'])->name('admin.games.edit');
    Route::put('/games/{game}', [App\Http\Controllers\AdminGameController::class, 'update'])->name('admin.games.update');
    Route::delete('/games/{game}', [App\Http\Controllers\AdminGameController::class, 'destroy'])->name('admin.games.destroy');
});
