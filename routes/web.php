<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterHostelController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', [DashboardController::class, 'index']);

Route::get('master-hotel', [MasterHostelController::class, 'index'])->name('hotel');
Route::get('master-hotel/create', [MasterHostelController::class, 'create']);
Route::post('master-hotel/store', [MasterHostelController::class, 'store']);
Route::get('master-hotel/{id}/edit', [MasterHostelController::class, 'edit']);
Route::patch('master-hotel/{id}', [MasterHostelController::class, 'update']);
Route::delete('master-hotel/{id}', [MasterHostelController::class, 'destroy']);

// Route::resource('master-hotel', MasterHostelController::class);
