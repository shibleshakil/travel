<?php

namespace App\Models;

use App\Traits\ResourceContainerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, ResourceContainerTrait;

    public function getDetailsById($id){

        $key = 'GET_SETTING_BY_ID';

        if($this->getResource($key)){
            return $this->getResource($key);
        }

        $query = $this->query()->findOrFail($id);
        return $this->setResource($key, $query);

    }
}
