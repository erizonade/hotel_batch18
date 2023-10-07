<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HotelRooms;
use Illuminate\Http\Request;

class RoomHotelController extends Controller
{
    public function getRoom($id)
    {
        $data = HotelRooms::with(['hotel'])->where('hotel_id', $id)->get();

        collect($data)->map(function($res) {
            $res->room_photo = asset('room/'.$res->room_photo);
        });

        return respons(true, 'Room Hotel', $data, 200);
    }

    public function getDetailRoom($idRoom)
    {
        $data = HotelRooms::with(['hotel'])->find($idRoom);
        return respons(true, 'Detail Room', $data, 200);
    }
}
