<?php

namespace App\Http\Controllers\Admin\Module\Car;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Car;
use App\Models\CarTerm;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class CarController extends Controller
{
    public function index(){
        $datas = Car::with('location')->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.car.index', compact('datas'));
    }

    public function search($name){
        if ($name == "All Data") {
            $datas = Car::with('location')->where('is_active', 1)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Car::with('location')->where('is_active', 1)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.car.filter', compact('datas', 'name'));
    }

    public function recovery(){
        $datas = Car::with('location')->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        return view('admin.module.car.recovery', compact('datas'));
    }

    public function recoverySearch($name){
        if ($name == "All Data") {
            $datas = Car::with('location')->where('is_active', 0)->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }else{
            $datas = Car::with('location')->where('is_active', 0)->where('name', 'like', '%' . $name .'%' )->orderBy('id', 'DESC')->paginate(PaginateHelper::adminPaginate());
        }
        return view('admin.module.car.recovery_filter', compact('datas', 'name'));
    }

    public function create(){
        $locations = Location::where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'car')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'car');
        })->get();

        return view('admin.module.car.create', compact('locations', 'attributes', 'attributeTerm'));
    }

    public function edit($id){
        $data = Car::findorFail($id);
        $data->faqs = json_decode($data->faqs);
        $data->spec = json_decode($data->spec);
        $data->extra_price = json_decode($data->extra_price);
        $data->galary_image = json_decode($data->galary_image);
        $carTerms = CarTerm::where('car_id', $id)->select('term_id')->get()->toArray();
        $carTerms = array_column($carTerms, 'term_id');

        $locations = Location::where('is_active', 1)->orderBy('name')->get();
        $attributes = Attribute::where('is_active', 1)->where('service', 'car')->orderBy('position')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'car');
        })->get();
        
        return view('admin.module.car.edit', compact('data', 'carTerms', 'locations', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;
            $parentName = '';
            $slug = SlugHelper::generateSlug($request->name, $parentName);
    
            if (!empty($slug)) {
                $chkSlug = Car::where('slug', $slug)->count();
    
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
    
            $data = new Car;
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->extra_price = $extraPrice;

            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->passenger = $request->passenger;
            $data->gear_shift = $request->gear_shift;
            $data->baggage = $request->baggage;
            $data->door = $request->door;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->car_number = $request->car_number;
            $data->price = $request->price;
            $data->sale_price = $request->sale_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stay = $request->min_day_stay;
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
                $term = $this->carTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'New Car Added Successfully!');
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
                $chkSlug = Car::where('slug', $slug)->count();
    
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
    
            $data = Car::findorFail($id);
            $data->slug = $slug;
            $data->faqs = $allfaqs;
            $data->extra_price = $extraPrice;

            $data->name = $request->name;
            $data->location_id = $request->location_id;
            $data->content = $request->content;
            $data->youtube_link = $request->youtube_link;
            $data->passenger = $request->passenger;
            $data->gear_shift = $request->gear_shift;
            $data->baggage = $request->baggage;
            $data->door = $request->door;
            $data->address = $request->address;
            $data->map_lat = $request->map_lat;
            $data->map_lng = $request->map_lng;
            $data->map_zoom = $request->map_zoom;
            $data->car_number = $request->car_number;
            $data->price = $request->price;
            $data->sale_price = $request->sale_price;
            $data->min_day_before_booking = $request->min_day_before_booking;
            $data->min_day_stay = $request->min_day_stay;
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
                $term = $this->carTerm($terms, $data, $loggedUser);
            }

            DB::commit();
            return back()->with('success', 'Car Information Updated Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function carTerm($terms, $car, $loggedUser){
        $deleteExist = DB::select('DELETE FROM car_terms WHERE car_id ='.$car->id.' ');

        foreach ($terms as $key => $termId) {
            $term = new CarTerm;
            $term->car_id = $car->id;
            $term->term_id = $termId;
            $term->created_by = $loggedUser;
            $term->save();
        }
        return 1;
    }

    public function delete($id){
        $data = Car::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }

    public function restore($id){
        $data = Car::findorFail($id);
        $data->is_active = 1;
        $data->updated_by = auth()->user()->id;
        $data->save();

        return "Data Restored Successfully!";
    }
}
