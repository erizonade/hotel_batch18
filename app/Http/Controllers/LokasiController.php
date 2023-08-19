<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::all();

        return view('lokasi.index', compact('lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lokasi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaLokasi'   => ['required', 'unique:lokasi,nama_lokasi'],
            'fotoLokasi'   => ['required', 'mimes:jpg,png,jpeg']
        ],[
            'required' => 'Seluruh form wajib diisi!',
            'namaLokasi.required' => 'Nama Lokasi tidak boleh kosong',
            'fotoLokasi.mimes' => 'hanya bisa jpg, png, jpeg'
        ]);

        if ($request->hasFile('fotoLokasi')) {
            $foto = $request->file('fotoLokasi');
            $nameFile = time().'.'.$foto->getClientOriginalExtension();

            $foto->move('lokasi', $nameFile);
        }

        Lokasi::insert([
            'nama_lokasi' => $request->namaLokasi,
            'foto_lokasi' => $nameFile,
            'created_at' => Carbon::now()
        ]);

        return redirect('master-lokasi')->with('status', 'berhasil menambahkan data lokasi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Lokasi::findOrFail($id);

        return view('lokasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaLokasi' => ['required', 'unique:lokasi,nama_lokasi,'.$id.',id'],
            'fotoLokasi'   => ['nullable', 'mimes:jpg,png,jpeg']
        ], [
            'required' => 'Seluruh form wajib diisi!'
        ]);

        $lokasi = Lokasi::find($id);

        if ($request->hasFile('fotoLokasi')) {
            $foto = $request->file('fotoLokasi');
            $namaFile = time().'.'.$foto->getClientOriginalExtension();

            $foto->move('lokasi', $namaFile);
            File::delete('lokasi'. $lokasi->foto_lokasi);
        }

        Lokasi::where('id', $id)
                   ->update([
                        'nama_lokasi'   => $request->namaLokasi,
                        'foto_lokasi'   => $namaFile ?? $lokasi->foto_lokasi
                   ]);

        return redirect('master-lokasi')->with('status', 'berhasil merubah data lokasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Lokasi::destroy($id);

        return redirect('master-lokasi')->with('status', 'berhasil menghapus data lokasi');
    }
}
