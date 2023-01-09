<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Helper\ImageHelper;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    public function updateProfile(Request $request)
    {
        $data = User::find(auth()->user()->id);
        if (!$data) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users,email,' . Auth()->user()->id],
                'mobile' => ['required', 'string'],
                'image' => ['nullable', 'mimes:jpg,bmp,png'],
            ]);
            $data = User::find(Auth()->user()->id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->mobile = $request->mobile;
            if ($file = $request->file('image')) {
                $data->image = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', 'image');
            }

            $data->save();

            DB::commit();
            return back()->with('success', 'Data Updated Successfully!');
        }

        return view('profile.edit', compact('data'));
    }
}
