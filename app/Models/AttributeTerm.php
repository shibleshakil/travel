<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeTerm extends Model
{
    use HasFactory;
    protected $table = 'attribute_terms';

    protected $fillable = [
        'name',
        'attribute_id',
        'slug',
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
