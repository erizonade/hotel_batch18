<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\MasterHotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function listHotel()
    {
        $data = MasterHotel::with('lokasi')
                           ->limit(4)
                           ->orderBy('id', 'desc')
                           ->get();

        //menumpuk data foto hotel / menggati isi foto hotel
        collect($data)->map(function($res) {
            $res->foto_hotel = asset('hotel/'.$res->foto_hotel);
        });

        return respons(true, 'Data Hotel', $data, 200);
    }

    public function getLokasi()
    {
        $data = Lokasi::limit(4)
                        ->orderBy('id', 'desc')
                        ->get();
        collect($data)->map(function($res) {
            $res->foto_lokasi = asset('lokasi/'.$res->foto_lokasi);
        });

        return respons(true, 'Data lokasi', $data, 200);
    }



}
