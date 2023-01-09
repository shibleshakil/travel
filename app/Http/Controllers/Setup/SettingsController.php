<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helper\ImageHelper;

class SettingsController extends Controller
{
    public function appSetting(Request $request)
    {
        $data = Setting::find(1);
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'app_title' => ['required', 'string'],
                'email' => ['nullable', 'email'],
                'logo' => ['image', 'max:2048'],
                'short_logo' => ['image', 'max:2048'],
                'favicon' => ['image', 'max:2048'],
            ]);
            // dd($request->all());
            $image_files = ['logo', 'short_logo', 'favicon'];
            $data->app_title = $request->app_title;
            $data->email = $request->email;

            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }

            $data->save();
            return back()->with('success', 'App Setting Updated Successfully!');
        }
        return view('setup.settings', compact('data'));
    }

    public function emailSetup(Request $request)
    {
        $data = Setting::find(1);
        if ($request->isMethod('post')) {
            if ($request->smtp_check) {
                $data->smtp_check = 1;
            } else {
                $data->smtp_check = 0;
            }
            $data->mail_transport = $request->mail_transport;
            $data->mail_host = $request->mail_host;
            $data->mail_port = $request->mail_port;
            $data->mail_encryption = $request->mail_encryption;
            $data->mail_username = $request->mail_username;
            $data->mail_password = $request->mail_password;
            $data->mail_from_name = $request->mail_from_name;
            $data->mail_from_address = $request->mail_from_address;

            $data->save();
            return back()->with('success', 'Email Configaration Setting Updated Successfully!');
        }
        return view('setup.email', compact('data'));
    }
}
