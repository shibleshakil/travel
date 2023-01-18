<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;

    protected $table = 'hotel_rooms';

    protected $fillable = [
        'name',
        'content',
        'price',
        'number',
        'beds',
        'size',
        'adults',
        'children',
        'min_day_stays',
        'status'
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
