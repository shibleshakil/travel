<?php

namespace App\Http\Controllers\Admin\Module\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Location;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelRoomTerm;
use App\Models\Attribute;
use App\Models\AttributeTerm;
use App\Helper\ImageHelper;
use App\Helper\PaginateHelper;
use App\Helper\SlugHelper;

class HotelRoomController extends Controller
{
    public function index($id){
        $hotel = Hotel::findorFail($id);
        $attributes = Attribute::where('is_active', 1)->where('service', 'hotel-room')->select('id', 'name')->orderBy('name')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'hotel-room');
        })->get();
        $datas = HotelRoom::where('is_active', 1)->where('hotel_id', $id)->get()->reverse();
        $sl = 0;

        return view('admin.module.hotel.room.index', compact('hotel', 'attributes', 'attributeTerm', 'datas', 'sl'));
    }

    public function edit($hotel, $id){
        $hotel = Hotel::findorFail($hotel);
        $data = HotelRoom::findorFail($id);
        $data->galary_image = json_decode($data->galary_image);
        $hotelTerms = HotelRoomTerm::where('room_id', $id)->select('term_id')->get()->toArray();
        $hotelTerms = array_column($hotelTerms, 'term_id');
        $attributes = Attribute::where('is_active', 1)->where('service', 'hotel-room')->select('id', 'name')->orderBy('name')->get();
        $attributeTerm = AttributeTerm::with('attribute')->where('is_active', 1)->whereHas('attribute', function($query){
            return $query->where('is_active', 1)->where('service', 'hotel-room');
        })->get();

        return view('admin.module.hotel.room.details', compact('hotel', 'data', 'hotelTerms', 'attributes', 'attributeTerm'));
    }

    public function store(Request $request, $hotel){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:hotel_rooms,name,'.$request->id.',id,hotel_id,'.$hotel],
            'price' => ['required', 'numeric'],
            'number' => ['required', 'numeric'],
        ]);
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;

            $data = new HotelRoom;
            $data->hotel_id = $hotel;
            $data->name = $request->name;
            $data->price = $request->price;
            $data->number = $request->number;
            $data->beds = $request->beds;
            $data->size = $request->size;
            $data->adults = $request->adults;
            $data->children = $request->children;
            $data->min_day_stays = $request->min_day_stays;
            $data->status = $request->status;
            $image_files = ['feature_image'];
    
            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }

            if ($galaryfile = $request->file('galary_image')) {
                $data->galary_image = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
    
            $data->created_by = $loggedUser;
            $data->save();
            if ($terms = $request->term_id) {    
                $term = $this->roomTerm($terms, $data, $loggedUser);
            }
            DB::commit();
            return back()->with('success', 'New Room Added Successfully!');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function roomTerm($terms, $room, $loggedUser){
        $deleteExist = DB::select('DELETE FROM hotel_room_terms WHERE room_id ='.$room->id.' ');

        foreach ($terms as $key => $termId) {
            $term = new HotelRoomTerm;
            $term->room_id = $room->id;
            $term->term_id = $termId;
            $term->created_by = $loggedUser;
            $term->save();
        }
        return 1;
    }
    
    public function update(Request $request, $hotel, $id){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:hotel_rooms,name,'.$id.',id,hotel_id,'.$hotel],
            'price' => ['required', 'numeric'],
            'number' => ['required', 'numeric'],
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user()->id;

            $data = HotelRoom::findorFail($id);
            $data->hotel_id = $hotel;
            $data->name = $request->name;
            $data->price = $request->price;
            $data->number = $request->number;
            $data->beds = $request->beds;
            $data->size = $request->size;
            $data->adults = $request->adults;
            $data->children = $request->children;
            $data->min_day_stays = $request->min_day_stays;
            $data->status = $request->status;
            $image_files = ['feature_image'];
    
            foreach ($image_files as $image_file) {
                if ($file = $request->file($image_file)) {
                    $data[$image_file] = ImageHelper::handleUpdatedUploadedImage($file, '/uploads/images', $data, '/uploads/images/', $image_file);
                }
            }

            if ($galaryfile = $request->file('galary_image')) {
                $data->galary_image = ImageHelper::handleUploadGalaryImage($galaryfile, '/uploads/images');
            }
    
            $data->created_by = $loggedUser;
            $data->save();
            if ($terms = $request->term_id) {    
                $term = $this->roomTerm($terms, $data, $loggedUser);
            }
            DB::commit();
            return back()->with('success', 'Room Information Updated Successfully!');

        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', $th->getMessage());
            return back()->with('error', 'Internal Server Error');
        }
    }

    public function delete($id){
        $data = HotelRoom::findorFail($id);
        $data->is_active = 0;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();

        return "Data Deleted Successfully!";
    }
}
