<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Wine\CategoryController;
use App\Http\Controllers\WineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('wines', WineController::class)->except(['show']);

    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::post('/add-to-cart', [ShopController::class, 'addToCart'])->name('addToCart');
        Route::post('/increment', [ShopController::class, 'increment'])->name('increment');
        Route::post('/decrement', [ShopController::class, 'decrement'])->name('decrement');
        Route::post('/remove', [ShopController::class, 'remove'])->name('remove');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/increment', [CartController::class, 'increment'])->name('increment');
        Route::post('/decrement', [CartController::class, 'decrement'])->name('decrement');
        Route::post('/remove', [CartController::class, 'remove'])->name('remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('clear');
    });


});
