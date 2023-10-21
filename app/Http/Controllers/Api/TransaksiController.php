<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelRooms;
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

        //checkin : 2023-10-10
        //checkout : 2023-10-12
        $checkin  = Carbon::parse($request->check_in)->format('Y-m-d');
        $checkout = Carbon::parse($request->check_out)->format('Y-m-d');

        if (Transaksis::where('user_id', auth()->user()->id)->where('room_id', $request->room_id)->where('status','!=', 3)->count()) return respons(false, 'Room sudah anda pesan', [], 422);

        //cehck apakah room sudah dipakai
        $check = Transaksis::where('room_id', $request->room_id)
                            ->where('check_in', '>=', $checkin)
                            ->where('check_out', '<=', $checkout)
                            ->whereNotIn('status',[2, 3])
                            ->where('user_id', auth()->user()->id)
                            ->count();

        if ($check) return respons(false, 'Room sudah ada yang booking', [], 422);

        try {



            //ini hitung hari dengan rentan tanggal
            $countDays = Carbon::parse($checkin)->diffInDays($checkout);
            // ini harga berdasarkan room
            $roomPrice = HotelRooms::find($request->room_id)->room_price;
            //ini hitung total harga
            $total = $roomPrice * $countDays;

            Transaksis::insert([
                'user_id' => auth()->user()->id,
                'room_id' => $request->room_id,
                'methode_bayar' => $request->methode_bayar,
                'check_in' => $checkin,
                'check_out' => $checkout,
                'status' => 2 /* Booking dan Belum Bayar */,
                'room_price' => $roomPrice,
                'total' => $total,
            ]);

            return respons(true, 'Booking Berhasil silakan lakukan pembayaran pada Detail Transaksi', [], 200);

        } catch (\Throwable $th) {
            return respons(false, $th->getMessage(), [], 500);
        }
    }

    public function konfirmasiTransaksi(Request $request)
    {
        //check validasi
        $validate = Validator::make($request->all(), [
            'bukti_bayar' => ['required','mimes:png,jpg,jpeg', 'image']
        ]);

        if ($validate->fails()) {
            return respons(false, $validate->errors()->first(), [], 422);
        }

        //check untuk upload foto
        if ($request->hasFile('bukti_bayar')) {
            //untuk upload foto ke folder public sesuai dengan folder transaksi
            $file = $request->file('bukti_bayar');
            $buktiBayar = time().'.'.$file->getClientOriginalExtension(); /*jpg, jpeg, png*/
            $file->move('transaksi', $buktiBayar);
        }

        try {

            Transaksis::where('id', $request->transaksi_id)->update([
                'bukti_bayar' => $buktiBayar,
                'status' => 0/*upload bukti bayar berhasil*/,
            ]);

            return respons(true, 'berhasil melakukan upload bukti bayar', [], 200);

        } catch (\Throwable $th) {
            return respons(false, $th->getMessage(), [], 500);
        }
    }

    public function historyTransaksi()
    {
        $data = Transaksis::with(['room'])
                          ->where('user_id', auth()->user()->id)
                          ->selectRaw('*, CASE WHEN status = 0
                                                    THEN "SELESAI UPLOAD BUKTI BAYAR"
                                               WHEN status = 1
                                                    THEN "TRANSAKSI SELESAI"
                                               ELSE "BELUM UPLOAD BUKTI BAYAR"
                                          END AS status_name
                                     ')
                          ->get();
        return respons(true, 'list history transaksi', $data, 200);
    }

    public function detailHistory($id)
    {
        $data = Transaksis::with(['room'])
                            ->selectRaw('*, CASE WHEN status = 0
                                                THEN "SELESAI UPLOAD BUKTI BAYAR"
                                            WHEN status = 1
                                                THEN "TRANSAKSI SELESAI"
                                            ELSE "BELUM UPLOAD BUKTI BAYAR"
                                        END AS status_name
                                    ')
                            ->find($id);
        return respons(true, 'detail history transaksi', $data, 200);
    }
}
