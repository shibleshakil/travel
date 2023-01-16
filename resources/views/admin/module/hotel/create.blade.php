@extends('layouts.back.master')
@section('title', 'Add New Hotel')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.index') }}">Hotel</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add New Hotel</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="column-selectors">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title" id="basic-layout-card-center">Add New Hotel</h4>
                        <form action="{{route ('admin.module.hotel.store') }}" method="post" enctype="multipart/form-data" class="form">@csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-content collapse show">
                                            <div class="form-card-header">
                                                <h4 id="basic-layout-card-center">Hotel Content</h4>
                                            </div>
                                            <div class="card-body">
                                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                                <div class="row">
                                                    <div class="form-group col-lg-12">
                                                        <label for="name">Hotel Title</label>
                                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Name of the hotel">
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label for="content">Content</label>
                                                        <textarea name="content" id="content" class="summernote">{!! nl2br(old('description')) !!}</textarea>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label for="youtube_link">Youtube Video Link</label>
                                                        <input type="url" name="youtube_link" id="youtube_link" class="form-control" value="{{old('youtube_link')}}" 
                                                        placeholder="Youtube Video Link">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Feature Image</label>
                                                        <input type="file" id="input-file-now" name="feature_image" class="dropify" />
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Gallery Image</label>
                                                        <input type="file" id="input-file-to-destroy" name="galary_image[]" class="dropify" data-allowed-file-extensions='["jpg"]' multiple/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="form-card-header">
                                            <h4 id="basic-layout-card-center">Hotel Policy</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="star_rate">Hotel rating standard</label>
                                                    <input type="number" name="star_rate" id="star_rate" class="form-control phone" placeholder="Ex:5">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="">Policy</label>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:45%">Title</th>
                                                                    <th style="width:45%">Content</th>
                                                                    <th style="width:10%"></th>
                                                                </tr>
                                                            </thead>
                                                            <input type="hidden" id="policy-count" value="0">
                                                            <tbody id="hotel-policy">
                                                                <tr id="hotel-policy-content_0">
                                                                    <td>
                                                                        <input type="text" name="policy_title[]" id="policy_title_0" class="form-control" 
                                                                        placeholder="Eg: What kind of footwear is most suitable ?">
                                                                    </td>
                                                                    <td>
                                                                        <textarea name="policy_content[]" id="policy_content_0" cols="30" class="form-control" rows="2"></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deletePolicy(this)" data-count="0">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-md pull-right" onclick="addPolicy(this)"><i class="fa fa-plus-circle"></i> Add More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card">
                                        <div class="form-card-header">
                                            <h4 id="basic-layout-card-center">Check in/out time</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="check_in_time">Time for check in</label>
                                                    <input type="time" name="check_in_time" id="check_in_time" class="form-control" placeholder="Eg: 12:00AM" value="11:00">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="check_out_time">Time for check out</label>
                                                    <input type="time" name="check_out_time" id="check_out_time" class="form-control" placeholder="Eg: 12:00AM" value="10:00">
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="min_day_before_booking">Minimum advance reservations</label>
                                                    <input type="number" name="min_day_before_booking" id="min_day_before_booking" class="form-control phone" placeholder="Ex:3">
                                                    <p class="font-italic">Leave blank if you dont need to use the min day option</p>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="min_day_stays">Minimum day stay requirements</label>
                                                    <input type="number" name="min_day_stays" id="min_day_stays" class="form-control phone" placeholder="Ex:2">
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
                                                    <input type="number" name="price" id="price" step="any" min="0" class="form-control phone" placeholder="Hotel Price">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>
                                                        <input type="checkbox" name="enable_extra_price" id="enable_extra_price" value="1"> Enable extra price
                                                    </label>
                                                </div>
                                                <div class="col-md-12 form-group d-none" id="extra-price-div">
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
                                                                <tr id="extra-price-content_0">
                                                                    <td>
                                                                        <input type="text" name="extra_price_name[]" id="extra_price_name_0" class="form-control" 
                                                                        placeholder="Extra price name">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="extra_price_price[]" id="extra_price_price_0" class="form-control" min="0" step="any">
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <select name="extra_price_type[]" id="extra_price_type_0" class="form-control select">
                                                                            <option value="one_time">One-time</option>
                                                                            <option value="per_day">Per day</option>
                                                                        </select>
                                                                        <br>
                                                                        <label>
                                                                            <input type="checkbox" name="extra_price_per_person[]" value="1"> Price per person
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteExtraPrice(this)" data-count="0">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
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
                                                            <option value="{{$loc->id}}">{{$loc->name}} {{$loc->parent ? ', ' . $loc->parentName->name : ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="address">Real address</label>
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Real address" autocomplete="off">
                                                </div>
                                                <div class="col-md-9 form-group">
                                                    <label for="">The geographic coordinate</label>
                                                    <div class="map-div"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="map_lat">Map Latitude</label>
                                                        <input type="text" name="map_lat" id="map_lat" class="form-control" placeholder="Ex:29.6585985">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="map_lng">Map Longitude</label>
                                                        <input type="text" name="map_lng" id="map_lng" class="form-control" placeholder="Ex:58.6585985">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="map_zoom">Map Zoom</label>
                                                        <input type="text" name="map_zoom" id="map_zoom" value="8" class="form-control">
                                                    </div>
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
                                                    <input type="radio" class="custom-control-input" id="Publish" name="status" value="Publish">
                                                    <label class="custom-control-label" for="Publish">Publish</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="Draft" name="status" value="Draft">
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
                                                <p>Hotel Featured</p>
                                                <label>
                                                    <input type="checkbox" name="is_feature" value="1"> Enable featured
                                                </label>
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
                                                                    <input type="checkbox" name="term_id[]" value="{{$attrTrm->id}}"> {{$attrTrm->name}}
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
                                            <button type="submit" id="submitBtn" class="btn btn-primary btn-md px-5"> <i class="fa fa-save"></i> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#enable_extra_price").change(function() {
                if(this.checked) {
                    $("#extra-price-div").removeClass('d-none');
                }else{
                    $("#extra-price-div").addClass('d-none');
                }
            });
        });

        function addPolicy(addP) {
            var policyCount = $("#policy-count").val();
            policyCount = policyCount  + 1;
            $("#policy-count").val(policyCount);

            var newPolicySec = '<tr id="hotel-policy-content_'+policyCount+'">'+
                '<td>'+
                    '<input type="text" name="policy_title[]" id="policy_title_'+policyCount+'" class="form-control" '+
                    'placeholder="Eg: What kind of footwear is most suitable ?">'+
                '</td>'+
                '<td>'+
                    '<textarea name="policy_content[]" id="policy_content_'+policyCount+'" cols="30" class="form-control" rows="2"></textarea>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deletePolicy(this)" data-count="'+policyCount+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#hotel-policy").append(newPolicySec);

        }

        function deletePolicy(delP) {
            var targetNo = $(delP).attr('data-count');
            var targetPolicy = $("#hotel-policy-content_"+targetNo).remove();
        }
        function addExtraPrice(addXP) {
            var expriceCount = $("#extra-price-count").val();
            expriceCount = expriceCount  + 1;
            $("#extra-price-count").val(expriceCount);

            var newExpriceSec = '<tr id="extra-price-content_0">'+
                '<td>'+
                    '<input type="text" name="extra_price_name[]" id="extra_price_name_0" class="form-control" '+
                    'placeholder="Extra price name">'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="extra_price_price[]" id="extra_price_price_0" class="form-control" min="0" step="any">'+
                '</td>'+
                '<td class="text-left">'+
                    '<select name="extra_price_type[]" id="extra_price_type_0" class="form-control select">'+
                        '<option value="one_time">One-time</option>'+
                        '<option value="per_day">Per day</option>'+
                    '</select>'+
                    '<br>'+
                    '<label>'+
                        '<input type="checkbox" name="extra_price_per_person[]" value="1"> Price per person'+
                    '</label>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteExtraPrice(this)" data-count="0">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#extra-price").append(newExpriceSec);

        }

        function deleteExtraPrice(delXP) {
            var targetNo = $(delXP).attr('data-count');
            var targetExprice = $("#extra-price-content_"+targetNo).remove();
        }
    </script>
@endsection