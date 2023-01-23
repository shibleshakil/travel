<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-content collapse show">
                <div class="form-card-header">
                    <h4 id="basic-layout-card-center">Space Content</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="name">Space Title</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name of the Space"
                            @if($url == 'admin.module.space.edit') value="{{$data->name}}"@else value="{{old('name')}}" @endif>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="summernote">@if($url == 'admin.module.space.edit'){!! nl2br($data->content) !!}@else{!! nl2br(old('content')) !!}@endif</textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="youtube_link">Youtube Video Link</label>
                            <input type="url" name="youtube_link" id="youtube_link" class="form-control"placeholder="Youtube Video Link"
                            @if($url == 'admin.module.space.edit') value="{{$data->youtube_link}}"@else value="{{old('youtube_link')}}" @endif>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">FAQs</label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:45%">Title</th>
                                            <th style="width:45%">Content</th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="faqs-count" value="0">
                                    <tbody id="Car-faqs">
                                        @if($url == 'admin.module.space.edit' && (sizeof($data->faqs) > 0))
                                            @php
                                                $psl = 1;
                                            @endphp
                                            @foreach ($data->faqs as $faqs)
                                                <tr id="Car-faqs-content_{{$psl}}">
                                                    <td>
                                                        <input type="text" name="faqs_title[]" id="faqs_title_{{$psl}}" class="form-control" 
                                                        placeholder="Eg: What kind of footwear is most suitable ?" value="{{$faqs->faqs_title}}">
                                                    </td>
                                                    <td>
                                                        <textarea name="faqs_content[]" id="faqs_content_{{$psl}}" cols="30" class="form-control" rows="2">{{$faqs->faqs_content}}</textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deletefaqs(this)" data-count="{{$psl}}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $psl = $psl + 1;
                                                @endphp
                                            @endforeach
                                        @else
                                            <tr id="Car-faqs-content_0">
                                                <td>
                                                    <input type="text" name="faqs_title[]" id="faqs_title_0" class="form-control" 
                                                    placeholder="Eg: What kind of footwear is most suitable ?">
                                                </td>
                                                <td>
                                                    <textarea name="faqs_content[]" id="faqs_content_0" cols="30" class="form-control" rows="2"></textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletefaqs(this)" data-count="0">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary btn-md pull-right" onclick="addfaqs(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="">Feature Image</label>
                            <input type="file" id="input-file-now" name="feature_image" class="dropify" 
                            @if($url == 'admin.module.space.edit' && $data->feature_image) data-default-file="{{asset ('uploads/images/'. $data->feature_image)}}" @endif />
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="">Gallery Image</label>
                                @if($url == 'admin.module.space.edit' && $data->galary_image)
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
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Extra Info</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="bed">No. Bed</label>
                        <input type="number" name="bed" min="0" step="1" id="bed" class="form-control phone" placeholder="Ex:2"
                        @if($url == 'admin.module.space.edit') value="{{$data->bed}}"@else value="{{old('bed')}}" @endif>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="bathroom">No. Bathroom</label>
                        <input type="number" name="bathroom" min="0" step="1" id="bathroom" class="form-control phone" placeholder="Ex:2"
                        @if($url == 'admin.module.space.edit') value="{{$data->bathroom}}"@else value="{{old('bathroom')}}" @endif>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="square">Square</label>
                        <input type="number" name="square" min="0" step="any" id="square" class="form-control phone" placeholder="Ex:150"
                        @if($url == 'admin.module.space.edit') value="{{$data->square}}"@else value="{{old('square')}}" @endif>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="min_day_before_booking">Minimum advance reservations</label>
                        <input type="number" name="min_day_before_booking" min="0" step="1" id="min_day_before_booking" class="form-control phone" placeholder="Ex:3" 
                        @if($url == 'admin.module.space.edit') value="{{$data->min_day_before_booking}}"@else value="{{old('min_day_before_booking')}}" @endif>
                        <p class="font-italic">Leave blank if you dont need to use the min day option</p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="min_day_stay">Minimum day stay requirements</label>
                        <input type="number" name="min_day_stay" min="0" step="1" id="min_day_stay" class="form-control phone" placeholder="Ex:4" 
                        @if($url == 'admin.module.space.edit') value="{{$data->min_day_stay}}"@else value="{{old('min_day_stay')}}" @endif>
                        <p class="font-italic">Leave blank if you dont need to set minimum day stay option</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Pricing</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" step="any" min="0" class="form-control phone" placeholder="Space Price" 
                        @if($url == 'admin.module.space.edit') value="{{$data->price}}"@else value="{{old('price')}}" @endif>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" name="sale_price" id="sale_price" step="any" min="0" class="form-control phone" placeholder="Space Sale Price" 
                        @if($url == 'admin.module.space.edit') value="{{$data->sale_price}}"@else value="{{old('sale_price')}}" @endif>
                        <p class="font-italic">If the regular price is less than the discount , it will show the regular price</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>
                            <input type="checkbox" name="enable_extra_price" id="enable_extra_price" value="1" 
                            @if($url == 'admin.module.space.edit' && $data->enable_extra_price == 1) checked @endif> Enable extra price
                        </label>
                    </div>
                    <div @if($url == 'admin.module.space.edit' && $data->enable_extra_price == 1) class="col-md-12 form-group"@else class="col-md-12 form-group d-none" @endif id="extra-price-div">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:40%">Name</th>
                                        <th style="width:25%">Price</th>
                                        <th style="width:25%">Type</th>
                                        <th style="width:10%"></th>
                                    </tr>
                                </thead>
                                <input type="hidden" id="extra-price-count" value="0">
                                <tbody id="extra-price">
                                    @if($url == 'admin.module.space.edit' && (sizeof($data->extra_price) > 0))
                                        @php
                                            $xp = 1;
                                        @endphp
                                        @foreach ($data->extra_price as $extra_price)
                                        <tr id="extra-price-content_{{$xp}}">
                                            <td>
                                                <input type="text" name="extra_price_name[]" id="extra_price_name_{{$xp}}" class="form-control" 
                                                placeholder="Extra price name" value="{{$extra_price->extra_price_name}}">
                                            </td>
                                            <td>
                                                <input type="number" name="extra_price_price[]" id="extra_price_price_{{$xp}}" class="form-control" min="0" step="any" 
                                                value="{{$extra_price->extra_price_price}}">
                                            </td>
                                            <td>
                                                <select name="extra_price_type[]" id="extra_price_type_{{$xp}}" class="form-control select">
                                                    <option value="one_time" @if($extra_price->extra_price_type == "one_time") selected @endif>One-time</option>
                                                    <option value="per_day" @if($extra_price->extra_price_type == "per_day") selected @endif>Per day</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteExtraPrice(this)" data-count="{{$xp}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                            @php
                                                $xp = $xp + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr id="extra-price-content_0">
                                            <td>
                                                <input type="text" name="extra_price_name[]" id="extra_price_name_0" class="form-control" 
                                                placeholder="Extra price name">
                                            </td>
                                            <td>
                                                <input type="number" name="extra_price_price[]" id="extra_price_price_0" class="form-control" min="0" step="any">
                                            </td>
                                            <td>
                                                <select name="extra_price_type[]" id="extra_price_type_0" class="form-control select">
                                                    <option value="one_time">One-time</option>
                                                    <option value="per_day">Per day</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteExtraPrice(this)" data-count="0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary btn-md pull-right" onclick="addExtraPrice(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Locations</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="location_id">Location</label>
                        <select name="location_id" id="location_id" class="select2 form-control">
                            <option value="">Select</option>
                            @foreach ($locations as $loc)
                                <option value="{{$loc->id}}" @if($url == 'admin.module.space.edit' && $data->location_id == $loc->id) selected @endif>
                                    {{$loc->name}} {{$loc->parent ? ', ' . $loc->parentName->name : ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="address">Real address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Real address" autocomplete="off" 
                        @if($url == 'admin.module.space.edit') value="{{$data->address}}" @else value="{{old('address')}}" @endif>
                    </div>
                    <div class="col-md-9 form-group">
                        <label for="">The geographic coordinate</label>
                        <div class="map-div"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="map_lat">Map Latitude</label>
                            <input type="text" name="map_lat" id="map_lat" class="form-control" placeholder="Ex:29.6585985"
                            @if($url == 'admin.module.space.edit') value="{{$data->map_lat}}" @else value="{{old('map_lat')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="map_lng">Map Longitude</label>
                            <input type="text" name="map_lng" id="map_lng" class="form-control" placeholder="Ex:58.6585985"
                            @if($url == 'admin.module.space.edit') value="{{$data->map_lng}}" @else value="{{old('map_lng')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="map_zoom">Map Zoom</label>
                            <input type="text" name="map_zoom" id="map_zoom" class="form-control"
                            @if($url == 'admin.module.space.edit') value="{{$data->map_zoom}}" @else value="{{old('map_zoom')}}" @endif>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Surroundings</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Education</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30%">Title</th>
                                        <th style="width:30%">Content</th>
                                        <th style="width:35%" colspan="2">Distance</th>
                                        {{-- <th style="width:5%">Unit</th> --}}
                                        <th style="width:5%"></th>
                                    </tr>
                                </thead>
                                <input type="hidden" id="education-count" value="0">
                                <tbody id="surrending-education">
                                    @if($url == 'admin.module.space.edit' && (sizeof($data->education) > 0))
                                        @php
                                            $psl = 1;
                                        @endphp
                                        @foreach ($data->education as $education)
                                            <tr id="education-content_{{$psl}}">
                                                <td>
                                                    <input type="text" name="education_title[]" id="education_title_{{$psl}}" class="form-control" 
                                                    placeholder="Sunny Beach" value="{{$education->education_title}}">
                                                </td>
                                                <td>
                                                    <textarea name="education_content[]" id="education_content_{{$psl}}" cols="30" class="form-control" rows="2">{{$education->education_content}}</textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="education_distance[]" id="education_distance_{{$psl}}" class="form-control" 
                                                    placeholder="" value="{{$education->education_distance}}">
                                                </td>
                                                <td>
                                                    <select name="education_unit[]" id="education_unit_{{$psl}}" class="form-control select">
                                                        <option value="m" @if($education->education_unit == "m") selected @endif>m</option>
                                                        <option value="km" @if($education->education_unit == "km") selected @endif>km</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteEducation(this)" data-count="{{$psl}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $psl = $psl + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr id="education-content_0">
                                            <td>
                                                <input type="text" name="education_title[]" id="education_title_0" class="form-control" 
                                                placeholder="Sunny Beach">
                                            </td>
                                            <td>
                                                <textarea name="education_content[]" id="education_content_0" cols="30" class="form-control" rows="2"></textarea>
                                            </td>
                                            <td>
                                                <input type="number" name="education_distance[]" id="education_distance_0" class="form-control" 
                                                placeholder="">
                                            </td>
                                            <td>
                                                <select name="education_unit[]" id="education_unit_0" class="form-control select">
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteEducation(this)" data-count="0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary btn-md pull-right" onclick="addEducation(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Health</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30%">Title</th>
                                        <th style="width:30%">Content</th>
                                        <th style="width:35%" colspan="2">Distance</th>
                                        {{-- <th style="width:5%">Unit</th> --}}
                                        <th style="width:5%"></th>
                                    </tr>
                                </thead>
                                <input type="hidden" id="health-count" value="0">
                                <tbody id="surrending-health">
                                    @if($url == 'admin.module.space.edit' && (sizeof($data->health) > 0))
                                        @php
                                            $psl = 1;
                                        @endphp
                                        @foreach ($data->health as $health)
                                            <tr id="health-content_{{$psl}}">
                                                <td>
                                                    <input type="text" name="health_title[]" id="health_title_{{$psl}}" class="form-control" 
                                                    placeholder="Sunny Beach" value="{{$health->health_title}}">
                                                </td>
                                                <td>
                                                    <textarea name="health_content[]" id="health_content_{{$psl}}" cols="30" class="form-control" rows="2">{{$health->health_content}}</textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="health_distance[]" id="health_distance_{{$psl}}" class="form-control" 
                                                    placeholder="" value="{{$health->health_distance}}">
                                                </td>
                                                <td>
                                                    <select name="health_unit[]" id="health_unit_{{$psl}}" class="form-control select">
                                                        <option value="m" @if($health->health_unit == "m") selected @endif>m</option>
                                                        <option value="km" @if($health->health_unit == "km") selected @endif>km</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteHealth(this)" data-count="{{$psl}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $psl = $psl + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr id="health-content_0">
                                            <td>
                                                <input type="text" name="health_title[]" id="health_title_0" class="form-control" 
                                                placeholder="Sunny Beach">
                                            </td>
                                            <td>
                                                <textarea name="health_content[]" id="health_content_0" cols="30" class="form-control" rows="2"></textarea>
                                            </td>
                                            <td>
                                                <input type="number" name="health_distance[]" id="health_distance_0" class="form-control" 
                                                placeholder="">
                                            </td>
                                            <td>
                                                <select name="health_unit[]" id="health_unit_0" class="form-control select">
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteHealth(this)" data-count="0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary btn-md pull-right" onclick="addHealth(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Transportation</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:30%">Title</th>
                                        <th style="width:30%">Content</th>
                                        <th style="width:35%" colspan="2">Distance</th>
                                        {{-- <th style="width:5%">Unit</th> --}}
                                        <th style="width:5%"></th>
                                    </tr>
                                </thead>
                                <input type="hidden" id="transportation-count" value="0">
                                <tbody id="surrending-transportation">
                                    @if($url == 'admin.module.space.edit' && (sizeof($data->transportation) > 0))
                                        @php
                                            $psl = 1;
                                        @endphp
                                        @foreach ($data->transportation as $transportation)
                                            <tr id="transportation-content_{{$psl}}">
                                                <td>
                                                    <input type="text" name="transportation_title[]" id="transportation_title_{{$psl}}" class="form-control" 
                                                    placeholder="Sunny Beach" value="{{$transportation->transportation_title}}">
                                                </td>
                                                <td>
                                                    <textarea name="transportation_content[]" id="transportation_content_{{$psl}}" cols="30" class="form-control" rows="2">{{$transportation->transportation_content}}</textarea>
                                                </td>
                                                <td>
                                                    <input type="number" name="transportation_distance[]" id="transportation_distance_{{$psl}}" class="form-control" 
                                                    placeholder="" value="{{$transportation->transportation_distance}}">
                                                </td>
                                                <td>
                                                    <select name="transportation_unit[]" id="transportation_unit_{{$psl}}" class="form-control select">
                                                        <option value="m" @if($transportation->transportation_unit == "m") selected @endif>m</option>
                                                        <option value="km" @if($transportation->transportation_unit == "km") selected @endif>km</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteTransportation(this)" data-count="{{$psl}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $psl = $psl + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr id="transportation-content_0">
                                            <td>
                                                <input type="text" name="transportation_title[]" id="transportation_title_0" class="form-control" 
                                                placeholder="Sunny Beach">
                                            </td>
                                            <td>
                                                <textarea name="transportation_content[]" id="transportation_content_0" cols="30" class="form-control" rows="2"></textarea>
                                            </td>
                                            <td>
                                                <input type="number" name="transportation_distance[]" id="transportation_distance_0" class="form-control" 
                                                placeholder="">
                                            </td>
                                            <td>
                                                <select name="transportation_unit[]" id="transportation_unit_0" class="form-control select">
                                                    <option value="m">m</option>
                                                    <option value="km">km</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteTransportation(this)" data-count="0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary btn-md pull-right" onclick="addTransportation(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Publish</h4>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <div class="d-inline-block custom-control custom-radio mr-1">
                        <input type="radio" class="custom-control-input" id="Publish" name="status" value="Publish" 
                        @if($url == 'admin.module.space.edit' && $data->status == "Publish") checked @else checked @endif>
                        <label class="custom-control-label" for="Publish">Publish</label>
                    </div>
                    <div class="d-inline-block custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="Draft" name="status" value="Draft" 
                        @if($url == 'admin.module.space.edit' && $data->status == "Draft") checked @endif>
                        <label class="custom-control-label" for="Draft">Draft</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="form-card-header">
                <h4 id="basic-layout-card-center">Availability</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <p>Car Featured</p>
                    <label>
                        <input type="checkbox" name="is_feature" value="1" 
                        @if($url == 'admin.module.space.edit' && $data->is_feature == 1) checked @endif> Enable featured
                    </label>
                </div>
                <div class="form-group">
                    <label for="default_state">Enable featured</label>
                    <select name="default_state" id="default_state" class="select form-control">
                        <option value="">Please</option>
                        <option value="1" @if($url == 'admin.module.space.edit' && $data->default_state == 1) selected @endif>Always available</option>
                        <option value="0" @if($url == 'admin.module.space.edit' && $data->default_state == 0) selected @endif>Only available on specific dates</option>
                    </select>
                </div>
            </div>
        </div>

        @if (sizeof($attributes) > 0)
            @foreach ($attributes as $attr)
                <div class="card">
                    <div class="form-card-header">
                        <h4 id="basic-layout-card-center">Attribute: {{$attr->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="attribute-terms">
                            @foreach ($attributeTerm->where('attribute_id', $attr->id) as $attrTrm)
                                <fieldset class="checkbox">
                                    <label>
                                        <input type="checkbox" name="term_id[]" value="{{$attrTrm->id}}" @if($url == 'admin.module.space.edit' && in_array($attrTrm->id, $spaceTerms)) checked @endif> {{$attrTrm->name}}
                                    </label>
                                </fieldset>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-body text-center">
                <button type="submit" id="submitBtn" class="btn btn-primary btn-md px-5"> <i class="fa fa-save"></i> @if($url == 'admin.module.space.edit') Save Changes @else Save @endif </button>
            </div>
        </div>
    </div>
</div>