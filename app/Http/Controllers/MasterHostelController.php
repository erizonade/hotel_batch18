<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\MasterHotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MasterHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['hotel'] = MasterHotel::with('lokasi')->get();

        return view('hotel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['lokasi'] = Lokasi::get();
        return view('hotel.tambah', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'namaHotel'   => ['required', 'unique:master_hotels,nama_hotel'],
            'alamatHotel' => 'required',
            'lokasiId'    => 'required',
            'hargaHotel'  => 'required|min:0',
            'fotoHotel'   => ['required', 'mimes:jpg,png,jpeg']
        ],[
            'required' => 'Seluruh form wajib diisi!',
            'namaHotel.required' => 'Nama Hotel tidak boleh kosong',
            'fotoHotel.mimes' => 'hanya bisa jpg, png, jpeg'
        ]);

        if ($request->hasFile('fotoHotel')) {
            $foto = $request->file('fotoHotel');
            $nameFile = time().'.'.$foto->getClientOriginalExtension();

            $foto->move('hotel', $nameFile);
        }

        MasterHotel::insert([
            'nama_hotel' => $request->namaHotel,
            'alamat_hotel' => $request->alamatHotel,
            'harga_hotel' => $request->hargaHotel,
            'foto_hotel' => $nameFile,
            'lokasi_id' => $request->lokasiId,
            'created_at' => Carbon::now()
        ]);

        return redirect('master-hotel')->with('status', 'berhasil menambahkan data hotel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $data = MasterHotel::where('id', $id)->first();
        // $data = MasterHotel::find($id);
        $data['hotel']  = MasterHotel::findOrFail($id);
        $data['lokasi'] = Lokasi::get();

        return view('hotel.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaHotel' => ['required', 'unique:master_hotels,nama_hotel,'.$id.',id'],
            'alamatHotel' => 'required',
            'lokasiId' => 'required',
            'hargaHotel'  => 'required|min:0',
            'fotoHotel'   => ['nullable', 'mimes:jpg,png,jpeg']
        ], [
            'required' => 'Seluruh form wajib diisi!'
        ]);

        $hotel = MasterHotel::find($id);

        if ($request->hasFile('fotoHotel')) {
            $foto = $request->file('fotoHotel');
            $namaFile = time().'.'.$foto->getClientOriginalExtension();

            $foto->move('hotel', $namaFile);
            File::delete('hotel'. $hotel->foto_hotel);
        }

        MasterHotel::where('id', $id)
                   ->update([
                        'nama_hotel'   => $request->namaHotel,
                        'alamat_hotel' => $request->alamatHotel,
                        'harga_hotel'   => $request->hargaHotel,
                        'lokasi_id'    => $request->lokasiId,
                        'foto_hotel'   => $namaFile ?? $hotel->foto_hotel
                   ]);

        return redirect('master-hotel')->with('status', 'berhasil merubah data hotel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // MasterHotel::where('id', $id)->delete();
        MasterHotel::destroy($id);

        return redirect('master-hotel')->with('status', 'berhasil menghapus data hotel');
    }
}
