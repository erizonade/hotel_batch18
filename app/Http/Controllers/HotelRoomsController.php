<?php

namespace App\Http\Controllers;

use App\Models\HotelRooms;
use Illuminate\Http\Request;

class HotelRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HotelRooms::join('master_hotels AS m', 'm.id', 'hotel_rooms.hotel_id')
                          ->select('hotel_rooms.*', 'm.hotel_name')
                          ->get();

        return view('room.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
