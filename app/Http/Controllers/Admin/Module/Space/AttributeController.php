<?php

namespace App\Http\Controllers\Admin\Module\Space;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class AttributeController extends Controller

{
    public function index(){
        $datas = Attribute::where('is_active', 1)->where('service', 'space')->get()->reverse();
        $sl = 0;

        return view('admin.module.space.attribute.index', compact('datas', 'sl'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:attributes,name,'.$request->id.',id,service,space'],
            'position' => ['nullable', 'numeric'],
        ]);
        $parentName = 'space';
        $data = new Attribute;
        $data->name = $request->name;
        $data->slug = SlugHelper::generateSlug($request->name, $parentName);
        $data->service = 'space';
        $data->position = $request->position;
        $data->created_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'New Space Attribute Added Successfully!');
    }
    
    public function edit($id){
        $data = Attribute::findorFail($id);

        return view('admin.module.space.attribute.details', compact('data'));
    }
    
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:attributes,name,'.$id.',id,service,space'],
            'position' => ['nullable', 'numeric'],
        ]);
        $parentName = 'space';
        $data = Attribute::findorFail($id);
        $data->name = $request->name;
        $data->slug = SlugHelper::generateSlug($request->name, $parentName);
        $data->service = 'space';
        $data->position = $request->position;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'Space Attribute Updated Successfully!');
    }

    public function delete($id){
        $data = Attribute::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }
    public function termList($id){
        $attributeInfo = Attribute::find($id);
        $datas = AttributeTerm::with('attribute')->where('is_active', 1)->where('attribute_id', $id)->get()->reverse();
        $sl = 0;

        return view('admin.module.space.attribute.termList', compact('attributeInfo', 'datas', 'sl'));
    }

    public function termStore(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:attribute_terms,name,'.$request->id.',id,attribute_id,'.$request->attribute_id],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $parentName = '';
        $image_files = ['image'];
        $attrSlug = Attribute::find($request->attribute_id)->slug;
        $data = new AttributeTerm;
        $data->name = $request->name;
        $data->slug = $attrSlug . '-' . SlugHelper::generateSlug($request->name, $parentName);
        $data->attribute_id = $request->attribute_id;
        $data->icon = $request->icon;
        foreach ($image_files as $image_file) {
            if ($file = $request->file($image_file)) {
                $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
            }
        }
        $data->created_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'New Attribute Term Added Successfully!');
    }
    
    public function termEdit($id){
        $data = AttributeTerm::findorFail($id);

        return view('admin.module.space.attribute.termDetails', compact('data'));
    }
    
    public function termUpdate(Request $request, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:attribute_terms,name,'.$id.',id,attribute_id,'.$request->attribute_id],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        $parentName = '';
        $image_files = ['image'];
        $attrSlug = Attribute::find($request->attribute_id)->slug;
        $data = AttributeTerm::findorFail($id);
        $data->name = $request->name;
        $data->slug = $attrSlug . '-' . SlugHelper::generateSlug($request->name, $parentName);
        $data->attribute_id = $request->attribute_id;
        $data->icon = $request->icon;
        foreach ($image_files as $image_file) {
            if ($file = $request->file($image_file)) {
                $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
            }
        }
        $data->updated_by = auth()->user()->id;
        $data->save();

        return back()->with('success', 'Attribute Term Updated Successfully!');
    }

    public function termDelete($id){
        $data = AttributeTerm::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }
}
