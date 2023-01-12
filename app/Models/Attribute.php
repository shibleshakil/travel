<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'slug',
        'service',
        'position',
    ];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
