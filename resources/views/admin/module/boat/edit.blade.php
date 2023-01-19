@extends('layouts.back.master')
@section('title', 'Edit Boat')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.boat.index') }}">Boat</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit Boat</a></li>
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
                                <h4 class="card-title" id="basic-layout-card-center">Edit Boat : {{$data->name}}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route ('admin.module.boat.index') }}" class="btn btn-info">Boat List</a>
                            </div>
                        </div>
                        <form action="{{route ('admin.module.boat.update', [$data->id]) }}" method="post" enctype="multipart/form-data" class="form">@csrf
                            @include('admin.module.boat.form')
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

        function addfaqs(addP) {
            var faqsCount = $("#faqs-count").val();
            faqsCount = faqsCount  + 1;
            $("#faqs-count").val(faqsCount);

            var newfaqsSec = '<tr id="Boat-faqs-content_'+faqsCount+'">'+
                '<td>'+
                    '<input type="text" name="faqs_title[]" id="faqs_title_'+faqsCount+'" class="form-control" '+
                    'placeholder="Eg: What kind of footwear is most suitable ?">'+
                '</td>'+
                '<td>'+
                    '<textarea name="faqs_content[]" id="faqs_content_'+faqsCount+'" cols="30" class="form-control" rows="2"></textarea>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deletefaqs(this)" data-count="'+faqsCount+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#Boat-faqs").append(newfaqsSec);

        }

        function deletefaqs(delP) {
            var targetNo = $(delP).attr('data-count');
            var targetfaqs = $("#Boat-faqs-content_"+targetNo).remove();
        }

        function addspec(addP) {
            var specCount = $("#spec-count").val();
            specCount = specCount  + 1;
            $("#spec-count").val(specCount);

            var newspecSec = '<tr id="Boat-spec-content_'+specCount+'">'+
                '<td>'+
                    '<input type="text" name="spec_title[]" id="spec_title_'+specCount+'" class="form-control" '+
                    'placeholder="Eg: manufacturer">'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="spec_content[]" id="spec_content_'+specCount+'" class="form-control" '+
                    'placeholder="Eg: Sunrise">'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deletespec(this)" data-count="'+specCount+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#Boat-spec").append(newspecSec);

        }

        function deletespec(delP) {
            var targetNo = $(delP).attr('data-count');
            var targetspec = $("#Boat-spec-content_"+targetNo).remove();
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