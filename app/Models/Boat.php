<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $table = 'boats';

    protected $fillable = [
        'name',
        'content',
        'slug',
        'youtube_link',
        'guest',
        'cabin',
        'length',
        'speed',
        'cancelation_policy',
        'additional_terms',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
        'hourly_price',
        'daily_price',
        'min_day_before_booking',
        'enable_extra_price',
        'status',
        'default_state',
        'is_feature',
    ];

    public function location(){
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
