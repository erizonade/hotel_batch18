<?php

namespace App\Http\Controllers;

use App\Models\Transaksis;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksis::with(['room', 'user'])->get();
        return view('transaksi.index', compact('data'));
    }

    public function approve($id)
    {
        try {

            Transaksis::where('id', $id)
                      ->update([
                        'status' => 1
                      ]);

            return redirect('transaksis')->with('status', 'transaksi booking telah di berhasil di komfirmasi');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function done($id)
    {
        try {
            Transaksis::where('id', $id)->update(['status' => 3]);
            return redirect('transaksis')->with('status', 'member selesai menginap');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
