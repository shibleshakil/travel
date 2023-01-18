<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'location_id',
        'slug',
        'content',
        'youtube_link',
        'star_rate',
        'policy',
        'check_in_time',
        'check_out_time',
        'min_day_before_booking',
        'min_day_stays',
        'price',
        'enable_extra_price',
        'extra_price',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
        'status',
        'is_feature',
        'feature_image',
        'galary_image',
    ];

    public function location(){
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
