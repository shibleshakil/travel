<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use Illuminate\Validation\Rules;

class PasswordController extends Controller
{
    public function changePassword(Request $request){
        if ($request->isMethod('post')) {
            $request->validate($this->rules(), $this->validationErrorMessages());

            DB::beginTransaction();
            try {
                $data = User::findOrFail(Auth()->user()->id);
                $data->password = Hash::make($request->password);
                $data->save();
                DB::commit();
                return back()->with('success', 'Password Changed Successfully!');
            } catch (\Throwable $th) {
                DB::rollback();
                return back()->with('error', 'Internal Server Error!');
            }
            
        }
        return view('profile.changePass');
    }

    

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
}
