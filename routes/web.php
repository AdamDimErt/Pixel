<?php

use App\Http\Controllers as HttpControllers;
use App\Models\GoodType;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->group(function () {
    //    Route::get('/', function () {
    //        return view('app');
    //    });
    Route::get('/', [HttpControllers\GoodController::class, 'index']);
    Route::get('/category/{goodType}', [HttpControllers\GoodController::class, 'goodList'])
        ->whereIn('goodType', GoodType::all()->pluck('code')->toArray())
        ->name('goodList');
    Route::post('/change-lang', [HttpControllers\LocalizationController::class, 'changeLang']);

    Route::post('/add-to-cart', [HttpControllers\CartController::class, 'addToCart']);
    Route::post('/remove-from-cart', [HttpControllers\CartController::class, 'removeFromCart']);
    Route::post('/cleanup-cart', [HttpControllers\CartController::class, 'cleanupCart']);
    Route::post('/additional-add', [HttpControllers\CartController::class, 'additionalAdd']);
    Route::post('/additional-remove', [HttpControllers\CartController::class, 'additionalRemove']);
    Route::get('/get-cart-count', [HttpControllers\CartController::class, 'getCartCount']);
    Route::get('/cart', [HttpControllers\CartController::class, 'cart'])->name('cart');
});

Route::prefix('/auth')->group(function () {
    Route::get('/logout', [HttpControllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/login', [HttpControllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [HttpControllers\AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [HttpControllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [HttpControllers\AuthController::class, 'storeUser'])->name('storeUser');
});

Route::prefix('/order')->group(function () {
    Route::get('confirm-order', [HttpControllers\OrderController::class, 'confirmOrder'])->name('confirmOrder');
    Route::post('settle-order', [HttpControllers\OrderController::class, 'settleOrder'])->name('settleOrder');
});

Route::prefix('/item')->group(function () {
    Route::get('/{item}/get-unavailable-dates', [HttpControllers\ItemController::class, 'getUnavailableDates'])->name('getUnavailableDates');
    Route::post('/{item}/get-available-times', [HttpControllers\ItemController::class, 'getAvailableTimes'])->name('getAvailableTimes');
    Route::post('/{item}/get-next-rent-times', [HttpControllers\ItemController::class, 'getAvailableRentEndTimespans'])->name('getAvailableRentEndTimespans');
});

Route::get('{good}', [HttpControllers\GoodController::class, 'view'])->name('view');
Route::get('autofill/{goodName}', [HttpControllers\GoodController::class, 'autofill'])->name('autofill');
