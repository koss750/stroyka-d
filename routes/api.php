<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Design;
use App\Http\Controllers\DesignController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/process', [DesignController::class, 'create'])->name('designs.create');
Route::get('/demo/designs/{category}/{limit}', [DesignController::class, 'getDemoDesigns'])->name('designs.getDemo');
Route::get('/designs/list', [DesignController::class, 'getList'])->name('designs.getList');
Route::get('/process', [DesignController::class, 'create'])->name('designs.create');
Route::post('/designs/{id}/update-order', [DesignController::class, 'updateOrder']);