<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function transaksi(Request $request)
    {
        $validate =  Validator::make($request->all(),[
            'check_in'  => ['required'],
            'check_out'  => ['required'],
            'methode_bayar'  => ['required'],
        ]);

        if ($validate->fails()) {
            return respons(false, $validate->errors()->first(), [], 422);
        }

        try {

            Transaksis::insert([
                'user_id' => auth()->user()->id,
                'room_id' => $request->room_id,
                'methode_bayar' => $request->methode_bayar,
                'check_in' => Carbon::parse($request->check_in)->format('Y-m-d'),
                'check_out' => Carbon::parse($request->check_out)->format('Y-m-d'),
                'status' => 2 /* Booking dan Belum Bayar */
            ]);

            return respons(true, 'Booking Berhasil silakan lakukan pembayaran pada Detail Transaksi', [], 200);

        } catch (\Throwable $th) {
            return respons(false, $th->getMessage(), [], 500);
        }
    }
}
