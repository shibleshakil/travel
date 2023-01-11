<?php

namespace App\Helper;
use DB;
use Str;

class SlugHelper {

    
    public static function generateSlug($string, $parent)
    {
        $slug = SlugHelper::strToSlug($string. ' ' .$parent);
        return $slug;
    }

    // Add Support for non-ascii string
    // Example বাংলাদেশ   ব্যাংকের    রিজার্ভের  অর্থ  চুরির   ঘটনায়   ফিলিপাইনের
    public static function strToSlug($string) {
        $slug = Str::slug($string);
        if(empty($slug)){
            $slug = preg_replace('/\s+/u', '-', trim($string));
        }
        return $slug;
    }
}