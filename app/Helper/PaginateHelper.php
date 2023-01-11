<?php

namespace App\Helper;
use App\Models\Setting;

class PaginateHelper {

    public static function adminPaginate(){
        $data = Setting::find(1)->admin_data_paginate;
        return $data;
    }

    public static function frontPaginate(){
        $data = Setting::find(1)->frontend_data_paginate;
        return $data;
    }
}