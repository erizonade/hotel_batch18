<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HotelRooms;
use App\Models\Lokasi;
use App\Models\MasterHotel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::insert([
            'name' => 'Admin',
            'email'=> 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'role_name' => 'Admin',
        ]);

        Lokasi::insert([
            'id' => 1,
            'nama_lokasi' => 'Palembang',
            'foto_lokasi' => '',
        ]);

        MasterHotel::insert([
            'nama_hotel' =>'Amaris',
            'alamat_hotel' => 'Jalan Inspektur Marzuki',
            'harga_hotel' => 230000,
            'foto_hotel' => '',
            'lokasi_id' => 1,
            'created_at' => Carbon::now()
        ]);

        HotelRooms::insert([
            'hotel_id' => 1,
            'room_name' => 'Room 12',
            'room_price' => 230000,
            'room_description' => 'Non Refundable, Non Smoking Area, Free Wifi, Bathtub, Air Conditioning, Refrigerator, Free Breakfast',
            'room_photo' => '',
        ]);
    }
}
