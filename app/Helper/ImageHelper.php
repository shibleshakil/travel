<?php

namespace App\Helper;

class ImageHelper
{

    public static function handleUpdatedUploadedImage($file, $path, $data, $delete_path, $field)
    {
        // dd($file, $path, $data, $delete_path, $field, public_path());
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . $path, $name);
        if ($data[$field] != null) {
            // dd(public_path() . $delete_path . $data[$field]);
            if (file_exists(public_path() . $delete_path . $data[$field])) {
                unlink(public_path() . $delete_path . $data[$field]);
            }
        }
        return $name;
    }

    public static function handleUploadGalaryImage($files, $path)
    {
        $fileName = [];
        foreach ($files as $key => $file) {
            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . $path, $name);
            array_push($fileName, $name);
        }
        
        return json_encode($fileName);
    }
}
