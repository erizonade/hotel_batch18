<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RoomHotelController;
use App\Http\Controllers\Api\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('list-hotel', [HomeController::class, 'listHotel']);
Route::get('lokasi', [HomeController::class, 'getLokasi']);
Route::get('hotel/{id}/detail', [HotelController::class, 'detailHotel']);
Route::get('search-hotel', [HotelController::class, 'searchHotel']);
Route::get('hotel-room/{idHotel}', [RoomHotelController::class, 'getRoom']);

/* AUTH */
Route::post('register', [LoginController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('detail-room/{id}', [RoomHotelController::class, 'getDetailRoom']);
    Route::get('history-transaksi', [TransaksiController::class, 'historyTransaksi']);
    Route::get('detail-history/{id}', [TransaksiController::class, 'detailHistory']);
    Route::post('transaksi', [TransaksiController::class, 'transaksi']);
    Route::post('konfirmasi-bayar', [TransaksiController::class, 'konfirmasiTransaksi']);
});
