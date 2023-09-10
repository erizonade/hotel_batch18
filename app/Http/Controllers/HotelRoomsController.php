<?php

namespace App\Http\Controllers;

use App\Models\HotelRoom;
use App\Models\HotelRooms;
use App\Models\MasterHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HotelRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HotelRooms::join('master_hotels AS m', 'm.id', 'hotel_rooms.hotel_id')
                          ->select('hotel_rooms.*', 'm.nama_hotel')
                          ->get();

        return view('room.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotel = MasterHotel::get();

        return view('room.tambah', compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => ['required'],
            'room_name' => ['required'],
            'room_price' => ['required'],
            'room_photo' => ['required','image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'room_description' => ['nullable']/* boleh kosong */,
        ]);

        try {

            /* tambah foto ke folder */
            if ($request->hasFile('room_photo')) {
                $file = $request->file('room_photo');
                $fileName = time().'.'.$file->getClientOriginalExtension();

                $file->move('room', $fileName);
            }

            HotelRooms::insert([
                'hotel_id' => $request->hotel_id,
                'room_name' => $request->room_name,
                'room_price' => $request->room_price,
                'room_description' => $request->room_description,
                'room_photo' => $fileName,
            ]);

            return redirect('rooms')->with('status', 'berhasil menambahkan room hotel');

        } catch (\Throwable $th) {
            throw $th;
        }

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
        $hotel = MasterHotel::get();
        $room  = HotelRooms::find($id);

        return view('room.edit', compact('hotel', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'hotel_id' => ['required'],
            'room_name' => ['required'],
            'room_price' => ['required', 'numeric'],
            'room_description' => ['nullable'],
            'room_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],/* jika update foto validasinya wajib nullable */
        ]);

        $roomEdit = HotelRooms::find($id);
        if($request->hasFile('room_photo')) {
            $file = $request->file('room_photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move('room', $fileName);

            File::delete('room'.$roomEdit->room_photo);
        }

        try {

            HotelRooms::where('id', $id)
                        ->update([
                            'hotel_id' => $request->hotel_id,
                            'room_name' => $request->room_name,
                            'room_price' => $request->room_price,
                            'room_description' => $request->room_description,
                            'room_photo' => $fileName ?? $roomEdit->room_photo,
                        ]);

            return redirect('rooms')->with('status', 'berhasil update hotel room');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // jika tidak inigin menggunakan delete maka gunakan destroy

        //contoh menggunakan method delete
        // HotelRooms::where('id', $id)->delete();

        //Contoh menggunakan destroy
        HotelRooms::destroy($id);

        //hasil tetap sama yang di ingat jika destroy primary key ny wajib filed name ny id

        return redirect('rooms')->with('status', 'berhasil hapus hotel room');
    }
}
