<?php

namespace App\Http\Controllers\Admin\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(){
        $datas = Location::where('is_active', 1)->get()->reverse();
        $sl = 0;
        return view('admin.location.index', compact('datas', 'sl'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:locations,name,'.$request->id.',id,parent,'.$request->parent],
            'parent' => ['nullable'],
        ]);
        $parentName = '';
        if (!empty($request->parent)) {
            $parentName = Location::find($request->parent)->name;
        }
        $data = new Location;
        $data->name = $request->name;
        $data->slug = SlugHelper::generateSlug($request->name, $parentName);
        $data->parent = $request->parent;
        $data->description = $request->description;
        $data->created_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'New Location Added Successfully!');
    }

    public function edit($id, $slug){
        $data = Location::findorFail($id);
        $datas = Location::where('is_active', 1)->where('id', '!=', $data->id)->orderBy('name')->get();
        return view('admin.location.details', compact('data', 'datas'));
    }

    public function update(Request $request, $id, $slug){
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', 'unique:locations,name,'.$id.',id,parent,'.$request->parent],
            'parent' => ['nullable'],
            'feature_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $parentName = '';
        if (!empty($request->parent)) {
            $parentName = Location::find($request->parent)->name;
        }
        $image_files = ['feature_image'];
        $data = Location::find($id);
        $data->name = $request->name;
        $data->slug = SlugHelper::generateSlug($request->name, $parentName);
        $data->parent = $request->parent;
        foreach ($image_files as $image_file) {
            if ($file = $request->file($image_file)) {
                $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
            }
        }
        $data->description = $request->description;
        $data->status = $request->status;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'Location Information Updated Successfully!');
    }

    public function delete($id){
        $data = Location::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }

}
