<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent',
        'feature_image',
        'map_lat',
        'map_lng',
        'map_zoom',
        'status'
    ];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function parentName(){
        return $this->belongsTo(Location::class, 'parent');
    }
}
