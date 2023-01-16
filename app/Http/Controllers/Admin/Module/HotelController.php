<?php

namespace App\Http\Controllers\Admin\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Attribute;
use App\Models\AttributeTerm;

class HotelController extends Controller
{
    public function index(){
        return view('admin.module.hotel.index');
    }

    public function create(){
        $locations = Location::where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'hotel')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'hotel');
        })->get();

        // dd($attributes,$attributeTerm);
        return view('admin.module.hotel.create', compact('locations', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request){
        dd($request->all());
        return view('admin.module.hotel.create');
    }
}
