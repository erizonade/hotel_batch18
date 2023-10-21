<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelRoomsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MasterHostelController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('proses-login', [LoginController::class, 'prosesLogin']);

Route::middleware(['auth','akseslogin:Admin'])->group(function() {


    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('master-hotel', [MasterHostelController::class, 'index'])->name('hotel');
    Route::get('master-hotel/create', [MasterHostelController::class, 'create']);
    Route::post('master-hotel/store', [MasterHostelController::class, 'store']);
    Route::get('master-hotel/{id}/edit', [MasterHostelController::class, 'edit']);
    Route::patch('master-hotel/{id}', [MasterHostelController::class, 'update']);
    Route::delete('master-hotel/{id}', [MasterHostelController::class, 'destroy']);

    //transaksi
    Route::get('transaksis', [TransaksiController::class, 'index']);
    Route::get('approve/{id}', [TransaksiController::class, 'approve']);
    Route::get('done/{id}', [TransaksiController::class,'done']);

    Route::resource('master-lokasi', LokasiController::class)->names('lokasi');

    Route::resource('user', UserController::class)->names('user');
    Route::resource('rooms', HotelRoomsController::class)->names('rooms');

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
