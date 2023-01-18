@extends('layouts.back.master')
@section('title', 'Edit Hotel')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.index') }}">Hotel</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit Hotel</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="column-selectors">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h4 class="card-title" id="basic-layout-card-center">Edit Hotel : {{$data->name}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route ('admin.module.hotel.index') }}" class="btn btn-info">Hotel List</a>
                            </div>
                        </div>
                        <form action="{{route ('admin.module.hotel.update', [$data->id]) }}" method="post" enctype="multipart/form-data" class="form">@csrf
                            @include('admin.module.hotel.form')
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
                '<td>'+
                    '<select name="extra_price_type[]" id="extra_price_type_0" class="form-control select">'+
                        '<option value="one_time">One-time</option>'+
                        '<option value="per_day">Per day</option>'+
                    '</select>'+
                    // '<br>'+
                    // '<label>'+
                    //     '<input type="checkbox" name="extra_price_per_person[]" value="1"> Price per person'+
                    // '</label>'+
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