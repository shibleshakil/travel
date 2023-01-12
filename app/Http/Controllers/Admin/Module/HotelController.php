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
        return view('admin.module.hotel.create');
    }
}
