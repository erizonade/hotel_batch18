<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRooms extends Model
{
    use HasFactory;

    public function hotel()
    {
        return $this->belongsTo(MasterHotel::class, 'hotel_id', 'id');
    }
}
