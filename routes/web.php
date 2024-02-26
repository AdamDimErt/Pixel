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
});
