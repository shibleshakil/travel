<?php

namespace App\Http\Controllers\Admin\Module\Boat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Boat;
use App\Models\BoatTerm;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class BoatController extends Controller
{
    public function index(){
        $datas = Boat::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.boat.index', compact('datas'));
    }

    public function search($name){
        if ($name == "All Data") {
            $datas = Boat::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Boat::with(['location','location.parentName'])->where('is_active', 1)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.boat.filter', compact('datas', 'name'));
    }

    public function recovery(){
        $datas = Boat::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.boat.recovery', compact('datas'));
    }

    public function recoverySearch($name){
        if ($name == "All Data") {
            $datas = Boat::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Boat::with(['location','location.parentName'])->where('is_active', 0)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.boat.recovery_filter', compact('datas', 'name'));
    }

    public function create(){
        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'boat')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'boat');
        })->get();

        return view('admin.module.boat.create', compact('locations', 'attributes', 'attributeTerm'));
    }

    public function edit($id){
        $data = Boat::findorFail($id);
        $data->faqs = json_decode($data->faqs);
        $data->spec = json_decode($data->spec);
        $data->extra_price = json_decode($data->extra_price);
        $data->galary_image = json_decode($data->galary_image);
        $boatTerms = BoatTerm::where('boat_id', $id)->select('term_id')->get()->toArray();
        $boatTerms = array_column($boatTerms, 'term_id');

        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'boat')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'boat');
        })->get();
        
        return view('admin.module.boat.edit', compact('data', 'boatTerms', 'locations', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Boat::where('slug', $slug)->count();
    
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

            $reqspec = array();
            if (sizeof($request->spec_title)) {
                foreach ($request->spec_title as $key => $value) {
                    $reqspec[] = [
                        'spec_title' => $value,
                        'spec_content' => $request->spec_content[$key] ? $request->spec_content[$key] : NULL,
                    ];
                }
            }
    
            $allspec = json_encode($reqspec);
    
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
    
            $data = new Boat;
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->spec = $allspec;
            $data->extra_price = $extraPrice;

            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->guest = $request->guest;
            $data->cabin = $request->cabin;
            $data->length = $request->length;
            $data->speed = $request->speed;
            $data->cancelation_policy = $request->cancelation_policy;
            $data->additional_terms = $request->additional_terms;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->hourly_price = $request->hourly_price;
            $data->daily_price = $request->daily_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->enable_extra_price = $request->enable_extra_price;
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
                $term = $this->boatTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'New Boat Added Successfully!');
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
                $chkSlug = Boat::where('slug', $slug)->count();
    
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

            $reqspec = array();
            if (sizeof($request->spec_title)) {
                foreach ($request->spec_title as $key => $value) {
                    $reqspec[] = [
                        'spec_title' => $value,
                        'spec_content' => $request->spec_content[$key] ? $request->spec_content[$key] : NULL,
                    ];
                }
            }
    
            $allspec = json_encode($reqspec);
    
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
    
            $data = Boat::findorFail($id);
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->spec = $allspec;
            $data->extra_price = $extraPrice;
            
            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->guest = $request->guest;
            $data->cabin = $request->cabin;
            $data->length = $request->length;
            $data->speed = $request->speed;
            $data->cancelation_policy = $request->cancelation_policy;
            $data->additional_terms = $request->additional_terms;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->hourly_price = $request->hourly_price;
            $data->daily_price = $request->daily_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->enable_extra_price = $request->enable_extra_price;
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
                $term = $this->boatTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'Boat Information Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function boatTerm($terms, $boat, $loggedUser){
        $deleteExist = DB::select('DELETE FROM boat_terms WHERE boat_id ='.$boat->id.' ');

        foreach ($terms as $key => $termId) {
            $term = new BoatTerm;
            $term->boat_id = $boat->id;
            $term->term_id = $termId;
            $term->created_by = $loggedUser;
            $term->save();
        }
        return 1;
    }

    public function delete($id){
        $data = Boat::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }

    public function restore($id){
        $data = Boat::findorFail($id);
        $data->is_active = 1;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return "Data Restored Successfully!";
    }
}