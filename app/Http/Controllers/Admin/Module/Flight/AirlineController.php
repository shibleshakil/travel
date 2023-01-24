<?php

namespace App\Http\Controllers\Admin\Module\Flight;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Airline;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class AirlineController extends Controller

{
    public function index(){
        $datas = Airline::where('is_active', 1)->get()->reverse();
        $sl = 0;

        return view('admin.module.flight.airline.index', compact('datas', 'sl'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:airlines,name,'.$request->id.',id'],
            'position' => ['nullable', 'numeric'],
        ]);
        $image_files = ['image'];
        $data = new Airline;
        $data->name = $request->name;
        foreach ($image_files as $image_file) {
            if ($file = $request->file($image_file)) {
                $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
            }
        }
        $data->created_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'New Airline Added Successfully!');
    }
    
    public function edit($id){
        $data = Airline::findorFail($id);

        return view('admin.module.flight.airline.details', compact('data'));
    }
    
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:airlines,name,'.$id.',id'],
            'position' => ['nullable', 'numeric'],
        ]);
        $image_files = ['image'];
        $data = Airline::findorFail($id);
        $data->name = $request->name;
        foreach ($image_files as $image_file) {
            if ($file = $request->file($image_file)) {
                $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
            }
        }
        $data->updated_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'Airline Updated Successfully!');
    }

    public function delete($id){
        $data = Airline::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }
}
