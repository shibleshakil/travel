<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-content collapse show">
                <div class="form-card-header">
                    <h4 id="basic-layout-card-center">Boat Content</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="name">Boat Title</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name of the Boat"
                            @if($url == 'admin.module.boat.edit') value="{{$data->name}}"@else value="{{old('name')}}" @endif>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="summernote">@if($url == 'admin.module.boat.edit'){!! nl2br($data->content) !!}@else{!! nl2br(old('content')) !!}@endif</textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="youtube_link">Youtube Video Link</label>
                            <input type="url" name="youtube_link" id="youtube_link" class="form-control"placeholder="Youtube Video Link"
                            @if($url == 'admin.module.boat.edit') value="{{$data->youtube_link}}"@else value="{{old('youtube_link')}}" @endif>
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
                                    <tbody id="Boat-faqs">
                                        @if($url == 'admin.module.boat.edit' && (sizeof($data->faqs) > 0))
                                            @php
                                                $psl = 1;
                                            @endphp
                                            @foreach ($data->faqs as $faqs)
                                                <tr id="Boat-faqs-content_{{$psl}}">
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
                                            <tr id="Boat-faqs-content_0">
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
                            @if($url == 'admin.module.boat.edit' && $data->feature_image) data-default-file="{{asset ('uploads/images/'. $data->feature_image)}}" @endif />
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="">Gallery Image</label>
                                @if($url == 'admin.module.boat.edit' && $data->galary_image)
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
                    <div class="col-md-3 form-group">
                        <label for="guest">Guest</label>
                        <input type="number" name="guest" min="0" step="1" id="guest" class="form-control phone" placeholder="Ex:50"
                        @if($url == 'admin.module.boat.edit') value="{{$data->guest}}"@else value="{{old('guest')}}" @endif>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="cabin">Cabin</label>
                        <input type="number" name="cabin" min="0" step="1" id="cabin" class="form-control phone" placeholder="Ex:5"
                        @if($url == 'admin.module.boat.edit') value="{{$data->cabin}}"@else value="{{old('cabin')}}" @endif>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="length">Length(m)</label>
                        <input type="number" name="length" min="0" step="any" id="length" class="form-control phone" placeholder="Ex:500"
                        @if($url == 'admin.module.boat.edit') value="{{$data->length}}"@else value="{{old('length')}}" @endif>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="speed">Speed(km/h)</label>
                        <input type="number" name="speed" min="0" step="1" id="speed" class="form-control phone" placeholder="Ex:45"
                        @if($url == 'admin.module.boat.edit') value="{{$data->guest}}"@else value="{{old('speed')}}" @endif>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Specification</label>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:45%">Title</th>
                                        <th style="width:45%">Content</th>
                                        <th style="width:10%"></th>
                                    </tr>
                                </thead>
                                <input type="hidden" id="spec-count" value="0">
                                <tbody id="Boat-spec">
                                    @if($url == 'admin.module.boat.edit' && (sizeof($data->spec) > 0))
                                        @php
                                            $psl = 1;
                                        @endphp
                                        @foreach ($data->spec as $spec)
                                            <tr id="Boat-spec-content_{{$psl}}">
                                                <td>
                                                    <input type="text" name="spec_title[]" id="spec_title_{{$psl}}" class="form-control" 
                                                    placeholder="Eg: manufacturer" value="{{$spec->spec_title}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="spec_content[]" id="spec_content_{{$psl}}" class="form-control" 
                                                    placeholder="Eg: Sunrise" value="{{$spec->spec_content}}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletespec(this)" data-count="{{$psl}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php
                                                $psl = $psl + 1;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr id="Boat-spec-content_0">
                                            <td>
                                                <input type="text" name="spec_title[]" id="spec_title_0" class="form-control" 
                                                placeholder="Eg: manufacturer">
                                            </td>
                                            <td>
                                                <input type="text" name="spec_content[]" id="spec_content_0" class="form-control" 
                                                placeholder="Eg: Sunrise">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deletespec(this)" data-count="0">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary btn-md pull-right" onclick="addspec(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="cancelation_policy">Cancellation Policy</label>
                        <textarea name="cancelation_policy" id="cancelation_policy" class="summernote">@if($url == 'admin.module.boat.edit'){!! nl2br($data->cancelation_policy) !!}@else{!! nl2br(old('cancelation_policy')) !!}@endif</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="additional_terms">Additional Terms & Information</label>
                        <textarea name="additional_terms" id="additional_terms" class="summernote">@if($url == 'admin.module.boat.edit'){!! nl2br($data->additional_terms) !!}@else{!! nl2br(old('additional_terms')) !!}@endif</textarea>
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
                                <option value="{{$loc->id}}" @if($url == 'admin.module.boat.edit' && $data->location_id == $loc->id) selected @endif>
                                    {{$loc->name}} {{$loc->parent ? ', ' . $loc->parentName->name : ''}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="address">Real address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Real address" autocomplete="off" 
                        @if($url == 'admin.module.boat.edit') value="{{$data->address}}" @else value="{{old('address')}}" @endif>
                    </div>
                    <div class="col-md-9 form-group">
                        <label for="">The geographic coordinate</label>
                        <div class="map-div"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="map_lat">Map Latitude</label>
                            <input type="text" name="map_lat" id="map_lat" class="form-control" placeholder="Ex:29.6585985"
                            @if($url == 'admin.module.boat.edit') value="{{$data->map_lat}}" @else value="{{old('map_lat')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="map_lng">Map Longitude</label>
                            <input type="text" name="map_lng" id="map_lng" class="form-control" placeholder="Ex:58.6585985"
                            @if($url == 'admin.module.boat.edit') value="{{$data->map_lng}}" @else value="{{old('map_lng')}}" @endif>
                        </div>
                        <div class="form-group">
                            <label for="map_zoom">Map Zoom</label>
                            <input type="text" name="map_zoom" id="map_zoom" class="form-control"
                            @if($url == 'admin.module.boat.edit') value="{{$data->map_zoom}}" @else value="{{old('map_zoom')}}" @endif>
                        </div>
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
                        <label for="hourly_price">Price per hour</label>
                        <input type="number" name="hourly_price" id="hourly_price" step="any" min="0" class="form-control phone" placeholder="Price per hour" 
                        @if($url == 'admin.module.boat.edit') value="{{$data->hourly_price}}"@else value="{{old('hourly_price')}}" @endif>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="daily_price">Price per day</label>
                        <input type="number" name="daily_price" id="daily_price" step="any" min="0" class="form-control phone" placeholder="Price per day" 
                        @if($url == 'admin.module.boat.edit') value="{{$data->daily_price}}"@else value="{{old('daily_price')}}" @endif>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="min_day_before_booking">Minimum advance reservations</label>
                        <input type="number" name="min_day_before_booking" min="0" step="1" id="min_day_before_booking" class="form-control phone" placeholder="Ex:3" 
                        @if($url == 'admin.module.boat.edit') value="{{$data->min_day_before_booking}}"@else value="{{old('min_day_before_booking')}}" @endif>
                        <p class="font-italic">Leave blank if you dont need to use the min day option</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>
                            <input type="checkbox" name="enable_extra_price" id="enable_extra_price" value="1" 
                            @if($url == 'admin.module.boat.edit' && $data->enable_extra_price == 1) checked @endif> Enable extra price
                        </label>
                    </div>
                    <div @if($url == 'admin.module.boat.edit' && $data->enable_extra_price == 1) class="col-md-12 form-group"@else class="col-md-12 form-group d-none" @endif id="extra-price-div">
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
                                    @if($url == 'admin.module.boat.edit' && (sizeof($data->extra_price) > 0))
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
                        @if($url == 'admin.module.boat.edit' && $data->status == "Publish") checked @else checked @endif>
                        <label class="custom-control-label" for="Publish">Publish</label>
                    </div>
                    <div class="d-inline-block custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="Draft" name="status" value="Draft" 
                        @if($url == 'admin.module.boat.edit' && $data->status == "Draft") checked @endif>
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
                    <p>Boat Featured</p>
                    <label>
                        <input type="checkbox" name="is_feature" value="1" 
                        @if($url == 'admin.module.boat.edit' && $data->is_feature == 1) checked @endif> Enable featured
                    </label>
                </div>
                <div class="form-group">
                    <label for="default_state">Enable featured</label>
                    <select name="default_state" id="default_state" class="select form-control">
                        <option value="">Please</option>
                        <option value="1" @if($url == 'admin.module.boat.edit' && $data->default_state == 1) selected @endif>Always available</option>
                        <option value="0" @if($url == 'admin.module.boat.edit' && $data->default_state == 0) selected @endif>Only available on specific dates</option>
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
                                        <input type="checkbox" name="term_id[]" value="{{$attrTrm->id}}" @if($url == 'admin.module.boat.edit' && in_array($attrTrm->id, $boatTerms)) checked @endif> {{$attrTrm->name}}
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
                <button type="submit" id="submitBtn" class="btn btn-primary btn-md px-5"> <i class="fa fa-save"></i> @if($url == 'admin.module.boat.edit') Save Changes @else Save @endif </button>
            </div>
        </div>
    </div>
</div>