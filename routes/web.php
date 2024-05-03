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
    Route::get('/', [HttpControllers\GoodController::class, 'index']);
    Route::get('/category/{goodType}', [HttpControllers\GoodController::class, 'goodList'])
        ->whereIn('goodType', GoodType::all()->pluck('code')->toArray())
        ->name('goodList');
    Route::get('/change-lang/{lang}', [HttpControllers\LocalizationController::class, 'changeLang'])->name('changeLang');

    Route::post('/add-to-cart', [HttpControllers\CartController::class, 'addToCart']);
    Route::post('/remove-from-cart', [HttpControllers\CartController::class, 'removeFromCart']);
    Route::post('/cleanup-cart', [HttpControllers\CartController::class, 'cleanupCart']);
    Route::post('/additional-add', [HttpControllers\CartController::class, 'additionalAdd']);
    Route::post('/additional-remove', [HttpControllers\CartController::class, 'additionalRemove']);
    Route::get('/get-cart-count', [HttpControllers\CartController::class, 'getCartCount']);
    Route::get('/cart', [HttpControllers\CartController::class, 'cart'])->name('cart');
    Route::post('/get-available-additions', [HttpControllers\CartController::class, 'getAvailableAdditionals']);
});

Route::prefix('/auth')->group(function () {
    Route::get('/logout', [HttpControllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/login', [HttpControllers\AuthController::class, 'login'])->name('login');
    Route::get('/need-to-confirm', [HttpControllers\AuthController::class, 'needConfirmation'])->name('needConfirmation');
    Route::get('/confirm/{confirmationCheckSum}', [HttpControllers\AuthController::class, 'confirmEmail'])->name('confirmEmail');
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
    Route::post('/{item}/get-rent-end-dates', [HttpControllers\ItemController::class, 'getUnavailableRentEndDates'])->name('getUnavailableRentEndDates');
    Route::post('/{item}/get-next-rent-times', [HttpControllers\ItemController::class, 'getAvailableRentEndTimespans'])->name('getAvailableRentEndTimespans');
});

Route::prefix('/profile')->group(function () {
    Route::get('/', [HttpControllers\ProfileController::class, 'viewProfile'])->name('viewProfile');
    Route::get('/edit', [HttpControllers\ProfileController::class, 'editProfile'])->name('editProfile');
    Route::post('/update', [HttpControllers\ProfileController::class, 'updateProfile'])->name('updateProfile');

    Route::prefix('/favorite')->group(function () {
        Route::get('/', [HttpControllers\FavoriteController::class, 'getFavorites'])->name('getFavorites');
        Route::get('/{good}/add', [HttpControllers\FavoriteController::class, 'add'])->name('addFavorite');
        Route::get('/{good}/remove', [HttpControllers\FavoriteController::class, 'remove'])->name('removeFavorite');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/', [HttpControllers\MyOrderController::class, 'getMyOrders'])->name('getMyOrders');
        Route::get('/{order}', [HttpControllers\MyOrderController::class, 'viewOrder'])->name('viewOrder');
        Route::get('/{order}/cancel', [HttpControllers\MyOrderController::class, 'cancelOrder'])->name('cancelOrder');
    });
});

Route::get('{good}', [HttpControllers\GoodController::class, 'view'])->name('viewGood');
Route::get('autofill/{goodName}', [HttpControllers\GoodController::class, 'autofill'])->name('autofill');
