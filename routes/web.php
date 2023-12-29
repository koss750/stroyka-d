<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\DailyAverageRateController;
use App\Http\Controllers\UIController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forex', [ExchangeRateController::class, 'index']);
Route::get('/export', [DesignController::class, 'exportAll']);
Route::get('/forex-day', [DailyAverageRateController::class, 'index']);

Route::get('/project/{id}', [UIController::class, 'showProject']);
Route::get('/browse', [DesignController::class, 'getDemoDesigns']);

