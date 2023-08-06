<?php

namespace App\Http\Controllers;

use App\Models\MasterHotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $hotel = MasterHotel::get();

        return view('hotel.index', compact('hotel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hotel.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'namaHotel' => 'required',
            'alamatHotel' => 'required',
        ],[
            'required' => 'Seluruh form wajib diisi!'
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
            'created_at' => Carbon::now()
        ]);

        return redirect('master-hotel')->back();

        // MasterHotel::create([
        //     'nama_hotel' => $request->namaHotel,
        //     'alamat_hotel' => $request->alamatHotel,
        //     'harga_hotel' => $request->hargaHotel,
        //     'foto_hotel' => '',
        // ]);


        // DB::table('master_hotels')->insert([
        //     'nama_hotel' => $request->namaHotel,
        //     'alamat_hotel' => $request->alamatHotel,
        //     'harga_hotel' => $request->hargaHotel,
        //     'foto_hotel' => '',
        //     'created_at' => Carbon::now()
        // ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
