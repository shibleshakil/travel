<?php

namespace App\Http\Controllers\Admin\Module\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Airport;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class AirportController extends Controller

{
    public function index(){
        $datas = [];
        $datas = Airport::where('is_active', 1)->get()->reverse();
        $locations = Location::with('parentName')->where('is_active', 1)->orderBy('name')->get();
        $sl = 0;

        return view('admin.module.flight.airport.index', compact('datas', 'locations', 'sl'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:airports,name,'.$request->id.',id,code,'.$request->code],
            'position' => ['nullable', 'numeric'],
        ]);
        $image_files = ['image'];
        $data = new Airport;
        $data->name = $request->name;
        $data->code = $request->code;
        $data->address = $request->address;
        $data->location_id = $request->location_id;
        $data->description = $request->description;
        $data->map_lat = $request->map_lat;
        $data->map_lng = $request->map_lng;
        $data->map_zoom = $request->map_zoom;
        $data->status = $request->status;
        $data->created_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'New Airport Added Successfully!');
    }
    
    public function edit($id){
        $data = Airport::findorFail($id);
        $locations = Location::with('parentName')->where('is_active', 1)->orderBy('name')->get();

        return view('admin.module.flight.airport.details', compact('data', 'locations'));
    }
    
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:airports,name,'.$id.',id,code,'.$request->code],
            'position' => ['nullable', 'numeric'],
        ]);
        $image_files = ['image'];
        $data = Airport::findorFail($id);
        $data->name = $request->name;
        $data->code = $request->code;
        $data->address = $request->address;
        $data->location_id = $request->location_id;
        $data->description = $request->description;
        $data->map_lat = $request->map_lat;
        $data->map_lng = $request->map_lng;
        $data->map_zoom = $request->map_zoom;
        $data->status = $request->status;
        
        $data->updated_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'Airport Updated Successfully!');
    }

    public function delete($id){
        $data = Airport::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }
}
