<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function detailHotel($id)
    {
        $data = MasterHotel::with(['lokasi'])->find($id);
        $data->foto_hotel = asset('hotel/'.$data->foto_hotel);

        return respons(true, 'Detail hotel', [$data], 200);
    }

    public function searchHotel(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'search' => 'min:3'
        ],[
            'min' => 'minimal 3 karakter'
        ]);

        if ($validator->fails()) {
            return respons(false, $validator->errors()->first(), [], 422);
        }

        $data = MasterHotel::with(['lokasi'])
                            ->where('nama_hotel', 'LIKE','%'.$request->search.'%')
                            ->orWhere('harga_hotel', 'LIKE','%'.$request->search.'%')
                            ->orWhereHas('lokasi', function($q) use ($request) {
                                $q->where('nama_lokasi', 'LIKE','%'.$request->search.'%');
                            })
                            ->get();
        collect($data)->map(function($res) {
            $res->foto_hotel = asset('hotel/'.$res->foto_hotel);
        });

        return respons(true, 'Search Hotel', $data, 200);
    }
}
