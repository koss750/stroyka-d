<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Design;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SupplierController;

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
Route::post('/designs/{id}/update-order', [DesignController::class, 'updateOrder']);
Route::get('/regions/search', [RegionController::class, 'searchRegions']);
Route::get('/regions', [RegionController::class, 'getAllRegions']);
Route::post('/register-legal-entity', [SupplierController::class, 'registerCompany']);
Route::post('/check-company', [SupplierController::class, 'checkCompany']);