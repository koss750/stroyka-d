<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\DailyAverageRateController;
use App\Http\Controllers\ChatController;
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
Route::get('/browse/220', [DesignController::class, 'getDemoDetail']);
Route::get('/order', [DesignController::class, 'getDemoOrder']);
Route::get('/checkout', [DesignController::class, 'getDemoCheckout']);
Route::get('/email-inbox', [UIController::class, 'email_inbox']);
Route::get('/email-compose', [UIController::class, 'email_compose']);
Route::get('/email-read', [UIController::class, 'email_read']);
Route::get('/chats/{conversation}', [ChatController::class, 'show'])->name('chats.show');


