<?php

namespace App\Helper;

class DateFormatHelper {

    public static function dateFormat($date){
        $formatDate = date('d-m-Y', strtotime($date));
        return $formatDate;
    }
}