<div class="row">
    <div class="form-group col-md-12">
        <label for="name">Room Name<span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Room Name"
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->name}}"@else value="{{old('name')}}" @endif required>
    </div>
    <div class="form-group col-md-6">
        <label for="">Feature Image</label>
        <input type="file" id="input-file-now" name="feature_image" class="dropify" 
        @if($url == 'admin.module.hotel.room.edit' && $data->feature_image) data-default-file="{{asset ('uploads/images/'. $data->feature_image)}}" @endif />
    </div>
    <div class="form-group col-md-12">
        <label for="">Gallery Image</label>
            @if($url == 'admin.module.hotel.room.edit' && $data->galary_image)
                <div class="row mb-2">
                    @foreach ($data->galary_image as $galImg)
                        <div class="col-md-2">
                            <img src="{{asset ('uploads/images/'. $galImg)}}" alt="Galary Image" class="galary-img">
                        </div>
                    @endforeach
                </div>
            @endif
            <input type="file" id="input-file-to-destroy" name="galary_image[]" class="dropify" data-allowed-file-extensions='["jpg"]' multiple/>
    </div>
    <div class="col-md-6 form-group">
        <label for="price">Price<span class="text-danger">*</span></label>
        <input type="number" name="price" id="price" step="any" min="0" class="form-control phone" placeholder="Price" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->price}}"@else value="{{old('price')}}" @endif required>
    </div>
    <div class="col-md-6 form-group">
        <label for="number">Number of room<span class="text-danger">*</span></label>
        <input type="number" name="number" id="number" step="1" min="0" class="form-control phone" placeholder="Number of room" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->number}}"@else value="{{old('number')}}" @endif required>
    </div>
    <div class="col-md-12 form-group">
        <label for="min_day_stays">Minimum day stay requirements</label>
        <input type="number" name="min_day_stays" id="min_day_stays" step="1" min="0"  class="form-control phone" placeholder="Ex:2" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->min_day_stays}}"@else value="{{old('min_day_stays')}}" @endif>
        <p class="font-italic">Leave blank if you dont need to set minimum day stay option</p>
    </div>
    <div class="col-md-6 form-group">
        <label for="beds">Number of beds</label>
        <input type="number" name="beds" id="beds" step="1" min="0" class="form-control phone" placeholder="Number of beds" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->beds}}"@else value="{{old('beds')}}" @endif>
    </div>
    <div class="col-md-6 form-group">
        <label for="size">Room Size</label>
        <div class="input-group">
            <input type="number" name="size" id="size" step="any" min="0" class="form-control phone" placeholder="Room Size" aria-describedby="basic-addon4"
            @if($url == 'admin.module.hotel.room.edit') value="{{$data->size}}"@else value="{{old('size')}}" @endif>
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon4">sqft</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 form-group">
        <label for="adults">Max Adults</label>
        <input type="number" name="adults" id="adults" step="1" min="0" class="form-control phone" placeholder="Max Adults" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->adults}}"@else value="{{old('adults')}}" @endif>
    </div>
    <div class="col-md-6 form-group">
        <label for="children">Max Children</label>
        <input type="number" name="children" id="children" step="1" min="0" class="form-control phone" placeholder="Max Children" 
        @if($url == 'admin.module.hotel.room.edit') value="{{$data->children}}"@else value="{{old('children')}}" @endif>
    </div>
    @if (sizeof($attributes) > 0)
        @foreach ($attributes as $attr)
        <div class="col-md-12 form-group">
            <label for="" class="font-weight-bold">Attribute: {{$attr->name}}</label>
            <div class="attribute-terms">
                @foreach ($attributeTerm->where('attribute_id', $attr->id) as $attrTrm)
                    <fieldset class="checkbox">
                        <label>
                            <input type="checkbox" name="term_id[]" value="{{$attrTrm->id}}" @if($url == 'admin.module.hotel.room.edit' && in_array($attrTrm->id, $hotelTerms)) checked @endif> {{$attrTrm->name}}
                        </label>
                    </fieldset>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif
    <div class="col-md-12 form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control select">
            <option value="Publish" @if($url == 'admin.module.hotel.room.edit' && $data->status == "Publish") selected @endif>Publish</option>
            <option value="Draft" @if($url == 'admin.module.hotel.room.edit' && $data->status == "Draft") selected @endif>Draft</option>
            <option value="Pending" @if($url == 'admin.module.hotel.room.edit' && $data->status == "Pending") selected @endif>Pending</option>
        </select>
    </div>
</div>