<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHotel extends Model
{
    use HasFactory;

    protected $table = 'master_hotels';

    protected $fillable = ['nama_hotel', 'alamat_hotel', 'harga_hotel', 'foto_hotel' ];
}
