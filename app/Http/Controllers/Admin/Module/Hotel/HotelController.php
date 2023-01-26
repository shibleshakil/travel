<?php

namespace App\Http\Controllers\Admin\Module\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Hotel;
use App\Models\HotelTerm;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class HotelController extends Controller
{
    public function index(){
        $datas = Hotel::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.hotel.index', compact('datas'));
    }

    public function search($name){
        if ($name == "All Data") {
            $datas = Hotel::with(['location','location.parentName'])->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Hotel::with(['location','location.parentName'])->where('is_active', 1)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.hotel.filter', compact('datas', 'name'));
    }

    public function recovery(){
        $datas = Hotel::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.hotel.recovery', compact('datas'));
    }

    public function recoverySearch($name){
        if ($name == "All Data") {
            $datas = Hotel::with(['location','location.parentName'])->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Hotel::with(['location','location.parentName'])->where('is_active', 0)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.hotel.recovery_filter', compact('datas', 'name'));
    }

    public function create(){
        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'hotel')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'hotel');
        })->get();

        return view('admin.module.hotel.create', compact('locations', 'attributes', 'attributeTerm'));
    }

    public function edit($id){
        $data = Hotel::findorFail($id);
        $data->policy = json_decode($data->policy);
        $data->extra_price = json_decode($data->extra_price);
        $data->galary_image = json_decode($data->galary_image);
        $hotelTerms = HotelTerm::where('hotel_id', $id)->select('term_id')->get()->toArray();
        $hotelTerms = array_column($hotelTerms, 'term_id');
        // dd($hotelTerms);
        $locations = Location::with(['parentName'])->where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'hotel')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'hotel');
        })->get();
        
        return view('admin.module.hotel.edit', compact('data', 'hotelTerms', 'locations', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {$loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Hotel::where('slug', $slug)->count();
    
                if ($chkSlug > 0) {
                    $slug = $slug . '-' . $chkSlug;
                }
            }
            $galaryImg = NULL;
            if ($galaryfile = $request->file('galary_image')) {
                $galaryImg = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
            
            $reqPolicy = array();
            if (sizeof($request->policy_title)) {
                foreach ($request->policy_title as $key => $value) {
                    $reqPolicy[] = [
                        'policy_title' => $value,
                        'policy_content' => $request->policy_content[$key] ? $request->policy_content[$key] : NULL,
                    ];
                }
            }
    
            $policies = json_encode($reqPolicy);
    
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
    
            $data = new Hotel;
            $data->name = $request->name;
            $data->slug = $slug;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->star_rate = $request->star_rate;
            $data->policy = $policies;
            $data->check_in_time = $request->check_in_time;
            $data->check_out_time = $request->check_out_time;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stays = $request->min_day_stays;
            $data->price = $request->price;
            $data->enable_extra_price = $request->enable_extra_price;
            $data->extra_price = $extraPrice;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->status = $request->status;
            $data->is_feature = $request->is_feature;
            $image_files = ['feature_image'];
    
            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }
    
            $data->galary_image = $galaryImg;
    
            $data->is_active = 1;
            $data->created_by = $loggedUser;
            $data->save();
            
            if ($terms = $request->term_id) {    
                $term = $this->hotelTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'New Hotel Added Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }

    }
    public function update(Request $request, $id){
        DB::beginTransaction();
        try {$loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Hotel::where('id', '!=', $id)->where('slug', $slug)->count();
    
                if ($chkSlug > 0) {
                    $slug = $slug . '-' . $chkSlug;
                }
            }
            $galaryImg = NULL;
            if ($galaryfile = $request->file('galary_image')) {
                $galaryImg = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
            
            $reqPolicy = array();
            if (sizeof($request->policy_title)) {
                foreach ($request->policy_title as $key => $value) {
                    $reqPolicy[] = [
                        'policy_title' => $value,
                        'policy_content' => $request->policy_content[$key] ? $request->policy_content[$key] : NULL,
                    ];
                }
            }
    
            $policies = json_encode($reqPolicy);
    
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
    
            $data = Hotel::findorFail($id);
            $data->name = $request->name;
            $data->slug = $slug;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->star_rate = $request->star_rate;
            $data->policy = $policies;
            $data->check_in_time = $request->check_in_time;
            $data->check_out_time = $request->check_out_time;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stays = $request->min_day_stays;
            $data->price = $request->price;
            $data->enable_extra_price = $request->enable_extra_price;
            $data->extra_price = $extraPrice;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->status = $request->status;
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
            // dd($request->term_id);
            if ($terms = $request->term_id) {    
                $term = $this->hotelTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'Hotel Information Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function hotelTerm($terms, $hotel, $loggedUser){
        $deleteExist = DB::select('DELETE FROM hotel_terms WHERE hotel_id ='.$hotel->id.' ');
        // dd($terms, $hotel, $loggedUser);

        foreach ($terms as $key => $termId) {
            $term = new HotelTerm;
            $term->hotel_id = $hotel->id;
            $term->term_id = $termId;
            $term->created_by = $loggedUser;
            $term->save();
        }
        return 1;
    }

    public function delete($id){
        $data = Hotel::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }

    public function restore($id){
        $data = Hotel::findorFail($id);
        $data->is_active = 1;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return "Data Restored Successfully!";
    }
}
