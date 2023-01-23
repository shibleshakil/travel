@extends('layouts.back.master')
@section('title', 'Add New Space')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.space.index') }}">Space</a></li>
                            <li class="breadcrumb-item active"><a href="#">Add New Space</a></li>
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
                                <h4 class="card-title" id="basic-layout-card-center">Add New Space</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route ('admin.module.space.index') }}" class="btn btn-info">Space List</a>
                            </div>
                        </div>
                        <form action="{{route ('admin.module.space.store') }}" method="post" enctype="multipart/form-data" class="form">@csrf
                            @include('admin.module.space.form')
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

            var newfaqsSec = '<tr id="Car-faqs-content_'+faqsCount+'">'+
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
            
            $("#Car-faqs").append(newfaqsSec);

        }

        function deletefaqs(delP) {
            var targetNo = $(delP).attr('data-count');
            var targetfaqs = $("#Car-faqs-content_"+targetNo).remove();
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

        function addEducation(addP) {
            var education = $("#education-count").val();
            education = education  + 1;
            $("#education-count").val(education);

            var newEducation = '<tr id="education-content_'+education+'">'+
                '<td>'+
                    '<input type="text" name="education_title[]" id="education_title_'+education+'" class="form-control" placeholder="Sunny Beach">'+
                '</td>'+
                '<td>'+
                    '<textarea name="education_content[]" id="education_content_'+education+'" cols="30" class="form-control" rows="2"></textarea>'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="education_distance[]" id="education_distance_'+education+'" class="form-control"> '+
                '</td>'+
                '<td>'+
                    '<select name="education_unit[]" id="education_unit_'+education+'" class="form-control select">'+
                        '<option value="m">m</option>'+
                        '<option value="km">km</option>'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteEducation(this)" data-count="'+education+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#surrending-education").append(newEducation);

        }

        function deleteEducation(delEd) {
            var targetNo = $(delEd).attr('data-count');
            var targetfaqs = $("#education-content_"+targetNo).remove();
        }

        function addHealth(addP) {
            var health = $("#health-count").val();
            health = health  + 1;
            $("#health-count").val(health);

            var newHealth = '<tr id="health-content_'+health+'">'+
                '<td>'+
                    '<input type="text" name="health_title[]" id="health_title_'+health+'" class="form-control" placeholder="Sunny Beach">'+
                '</td>'+
                '<td>'+
                    '<textarea name="health_content[]" id="health_content_'+health+'" cols="30" class="form-control" rows="2"></textarea>'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="health_distance[]" id="health_distance_'+health+'" class="form-control"> '+
                '</td>'+
                '<td>'+
                    '<select name="health_unit[]" id="health_unit_'+health+'" class="form-control select">'+
                        '<option value="m">m</option>'+
                        '<option value="km">km</option>'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteHealth(this)" data-count="'+health+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#surrending-health").append(newHealth);

        }

        function deleteHealth(delEd) {
            var targetNo = $(delEd).attr('data-count');
            var targetfaqs = $("#health-content_"+targetNo).remove();
        }

        function addTransportation(addP) {
            var transportation = $("#transportation-count").val();
            transportation = transportation  + 1;
            $("#transportation-count").val(transportation);

            var newTransportation = '<tr id="transportation-content_'+transportation+'">'+
                '<td>'+
                    '<input type="text" name="transportation_title[]" id="transportation_title_'+transportation+'" class="form-control" placeholder="Sunny Beach">'+
                '</td>'+
                '<td>'+
                    '<textarea name="transportation_content[]" id="transportation_content_'+transportation+'" cols="30" class="form-control" rows="2"></textarea>'+
                '</td>'+
                '<td>'+
                    '<input type="number" name="transportation_distance[]" id="transportation_distance_'+transportation+'" class="form-control"> '+
                '</td>'+
                '<td>'+
                    '<select name="transportation_unit[]" id="transportation_unit_'+transportation+'" class="form-control select">'+
                        '<option value="m">m</option>'+
                        '<option value="km">km</option>'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<button type="button" class="btn btn-danger btn-sm" onclick="deleteTransportation(this)" data-count="'+transportation+'">'+
                        '<i class="fa fa-trash"></i>'+
                    '</button>'+
                '</td>'+
            '</tr>';
            
            $("#surrending-transportation").append(newTransportation);

        }

        function deleteTransportation(delEd) {
            var targetNo = $(delEd).attr('data-count');
            var targetfaqs = $("#transportation-content_"+targetNo).remove();
        }
    </script>
@endsection