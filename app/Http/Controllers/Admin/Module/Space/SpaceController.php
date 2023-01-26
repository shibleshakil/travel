<?php

namespace App\Http\Controllers\Admin\Module\Space;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Space;
use App\Models\SpaceTerm;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class SpaceController extends Controller
{
    public function index(){
        $datas = Space::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.space.index', compact('datas'));
    }

    public function search($name){
        if ($name == "All Data") {
            $datas = Space::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Space::with(['location','location.parentName'])->where('is_active', 1)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.space.filter', compact('datas', 'name'));
    }

    public function recovery(){
        $datas = Space::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.space.recovery', compact('datas'));
    }

    public function recoverySearch($name){
        if ($name == "All Data") {
            $datas = Space::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Space::with(['location','location.parentName'])->where('is_active', 0)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.space.recovery_filter', compact('datas', 'name'));
    }

    public function create(){
        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'space')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'space');
        })->get();

        return view('admin.module.space.create', compact('locations', 'attributes', 'attributeTerm'));
    }

    public function edit($id){
        $data = Space::findorFail($id);
        $data->faqs = json_decode($data->faqs);
        $data->education = json_decode($data->education);
        $data->transportation = json_decode($data->transportation);
        $data->health = json_decode($data->health);
        $data->extra_price = json_decode($data->extra_price);
        $data->galary_image = json_decode($data->galary_image);
        $spaceTerms = SpaceTerm::where('space_id', $id)->select('term_id')->get()->toArray();
        $spaceTerms = array_column($spaceTerms, 'term_id');

        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'space')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'space');
        })->get();
        
        return view('admin.module.space.edit', compact('data', 'spaceTerms', 'locations', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Space::where('slug', $slug)->count();
    
                if ($chkSlug > 0) {
                    $slug = $slug . '-' . $chkSlug;
                }
            }
            $galaryImg = NULL;
            if ($galaryfile = $request->file('galary_image')) {
                $galaryImg = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
            
            $reqfaqs = array();
            if (sizeof($request->faqs_title)) {
                foreach ($request->faqs_title as $key => $value) {
                    $reqfaqs[] = [
                        'faqs_title' => $value,
                        'faqs_content' => $request->faqs_content[$key] ? $request->faqs_content[$key] : NULL,
                    ];
                }
            }
            $allfaqs = json_encode($reqfaqs);
    
            $reqExtraPrice = array();
            if (sizeof($request->extra_price_name)) {
                foreach ($request->extra_price_name as $key1 => $value) {
                    $reqExtraPrice[] = [
                        'extra_price_name' => $value,
                        'extra_price_price' => $request->extra_price_price[$key1] ? $request->extra_price_price[$key1] : NULL,
                        'extra_price_type' => $request->extra_price_type[$key1] ? $request->extra_price_type[$key1] : NULL,
                    ];
                }
            }
            $extraPrice = json_encode($reqExtraPrice);
    
            $reEducation = array();
            if (sizeof($request->education_title)) {
                foreach ($request->education_title as $key1 => $value) {
                    $reEducation[] = [
                        'education_title' => $value,
                        'education_content' => $request->education_content[$key1] ? $request->education_content[$key1] : NULL,
                        'education_distance' => $request->education_distance[$key1] ? $request->education_distance[$key1] : NULL,
                        'education_unit' => $request->education_unit[$key1] ? $request->education_unit[$key1] : NULL,
                    ];
                }
            }
            $education = json_encode($reEducation);
    
            $reTransportation = array();
            if (sizeof($request->transportation_title)) {
                foreach ($request->transportation_title as $key1 => $value) {
                    $retransportation[] = [
                        'transportation_title' => $value,
                        'transportation_content' => $request->transportation_content[$key1] ? $request->transportation_content[$key1] : NULL,
                        'transportation_distance' => $request->transportation_distance[$key1] ? $request->transportation_distance[$key1] : NULL,
                        'transportation_unit' => $request->transportation_unit[$key1] ? $request->transportation_unit[$key1] : NULL,
                    ];
                }
            }
            $transportation = json_encode($reTransportation);
    
            $reHealth = array();
            if (sizeof($request->health_title)) {
                foreach ($request->health_title as $key1 => $value) {
                    $rehealth[] = [
                        'health_title' => $value,
                        'health_content' => $request->health_content[$key1] ? $request->health_content[$key1] : NULL,
                        'health_distance' => $request->health_distance[$key1] ? $request->health_distance[$key1] : NULL,
                        'health_unit' => $request->health_unit[$key1] ? $request->health_unit[$key1] : NULL,
                    ];
                }
            }
            $health = json_encode($reHealth);
    
            $data = new Space;
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->extra_price = $extraPrice;
            $data->education = $education;
            $data->transportation = $transportation;
            $data->health = $health;

            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->bed = $request->bed;
            $data->bathroom = $request->bathroom;
            $data->square = $request->square;
            $data->price = $request->price;
            $data->sale_price = $request->sale_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stay = $request->min_day_stay;
            $data->enable_extra_price = $request->enable_extra_price;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->status = $request->status;
            $data->default_state = $request->default_state;
            $data->is_feature = $request->is_feature;

            $image_files = ['feature_image'];
            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }
    
            if ($request->galary_image) {
                $data->galary_image = $galaryImg;
            }

            $data->is_active = 1;
            $data->created_by = $loggedUser;
            $data->save();
            
            if ($terms = $request->term_id) {    
                $term = $this->spaceTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'New Space Added Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }

    }
    public function update(Request $request, $id){
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Space::where('slug', $slug)->count();
    
                if ($chkSlug > 0) {
                    $slug = $slug . '-' . $chkSlug;
                }
            }
            $galaryImg = NULL;
            if ($galaryfile = $request->file('galary_image')) {
                $galaryImg = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
            
            $reqfaqs = array();
            if (sizeof($request->faqs_title)) {
                foreach ($request->faqs_title as $key => $value) {
                    $reqfaqs[] = [
                        'faqs_title' => $value,
                        'faqs_content' => $request->faqs_content[$key] ? $request->faqs_content[$key] : NULL,
                    ];
                }
            }
            $allfaqs = json_encode($reqfaqs);
    
            $reqExtraPrice = array();
            if (sizeof($request->extra_price_name)) {
                foreach ($request->extra_price_name as $key1 => $value) {
                    $reqExtraPrice[] = [
                        'extra_price_name' => $value,
                        'extra_price_price' => $request->extra_price_price[$key1] ? $request->extra_price_price[$key1] : NULL,
                        'extra_price_type' => $request->extra_price_type[$key1] ? $request->extra_price_type[$key1] : NULL,
                    ];
                }
            }
            $extraPrice = json_encode($reqExtraPrice);
    
            $reEducation = array();
            if (sizeof($request->education_title)) {
                foreach ($request->education_title as $key1 => $value) {
                    $reEducation[] = [
                        'education_title' => $value,
                        'education_content' => $request->education_content[$key1] ? $request->education_content[$key1] : NULL,
                        'education_distance' => $request->education_distance[$key1] ? $request->education_distance[$key1] : NULL,
                        'education_unit' => $request->education_unit[$key1] ? $request->education_unit[$key1] : NULL,
                    ];
                }
            }
            $education = json_encode($reEducation);
    
            $reTransportation = array();
            if (sizeof($request->transportation_title)) {
                foreach ($request->transportation_title as $key1 => $value) {
                    $retransportation[] = [
                        'transportation_title' => $value,
                        'transportation_content' => $request->transportation_content[$key1] ? $request->transportation_content[$key1] : NULL,
                        'transportation_distance' => $request->transportation_distance[$key1] ? $request->transportation_distance[$key1] : NULL,
                        'transportation_unit' => $request->transportation_unit[$key1] ? $request->transportation_unit[$key1] : NULL,
                    ];
                }
            }
            $transportation = json_encode($reTransportation);
    
            $reHealth = array();
            if (sizeof($request->health_title)) {
                foreach ($request->health_title as $key1 => $value) {
                    $rehealth[] = [
                        'health_title' => $value,
                        'health_content' => $request->health_content[$key1] ? $request->health_content[$key1] : NULL,
                        'health_distance' => $request->health_distance[$key1] ? $request->health_distance[$key1] : NULL,
                        'health_unit' => $request->health_unit[$key1] ? $request->health_unit[$key1] : NULL,
                    ];
                }
            }
            $health = json_encode($reHealth);
    
            $data = Space::findorFail($id);
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->extra_price = $extraPrice;
            $data->education = $education;
            $data->transportation = $transportation;
            $data->health = $health;

            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->bed = $request->bed;
            $data->bathroom = $request->bathroom;
            $data->square = $request->square;
            $data->price = $request->price;
            $data->sale_price = $request->sale_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stay = $request->min_day_stay;
            $data->enable_extra_price = $request->enable_extra_price;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->status = $request->status;
            $data->default_state = $request->default_state;
            $data->is_feature = $request->is_feature;

            $image_files = ['feature_image'];
            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }
    
            if ($request->galary_image) {
                $data->galary_image = $galaryImg;
            }
    
            $data->is_active = 1;
            $data->updated_by = $loggedUser;
            $data->save();

            if ($terms = $request->term_id) {    
                $term = $this->spaceTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'Space Information Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function spaceTerm($terms, $space, $loggedUser){
        $deleteExist = DB::select('DELETE FROM space_terms WHERE space_id ='.$space->id.' ');

        foreach ($terms as $key => $termId) {
            $term = new SpaceTerm;
            $term->space_id = $space->id;
            $term->term_id = $termId;
            $term->created_by = $loggedUser;
            $term->save();
        }
        return 1;
    }

    public function delete($id){
        $data = Space::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }

    public function restore($id){
        $data = Space::findorFail($id);
        $data->is_active = 1;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return "Data Restored Successfully!";
    }
}
