@extends('layouts.back.master')
@section('title', 'Car Attribute')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.car.index') }}">Car</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.car.attribute.index') }}">Attribute</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.car.attribute.termList',["id"=>$data->attribute->id]) }}">Attribute : {{$data->attribute->name}}</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="column-selectors">
                <div class="row justify-content-center">
                    <div class="col-md-6">
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
                        <div class="card">
                            <div class="form-card-header">
                                <h4 class="card-title" id="basic-layout-card-center">Edit {{$data->name}}</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route ('admin.module.car.attribute.termUpdate', ['id'=>$data->id]) }}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="name">Name<span class="text-danger">*</span></label>
                                                <input type="text" id="name" class="form-control" placeholder="name" name="name" value="{{$data->name}}" required>
                                                <input type="hidden" name="attribute_id" value="{{$data->attribute_id}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="icon">Icon Class - get icon in 
                                                    <a href="http://fontawesome.com" target="_blank" rel="noopener noreferrer">fontawesome.com</a> or 
                                                    <a href="http://icofont.com" target="_blank" rel="noopener noreferrer">icofont.com</a>
                                                </label>
                                                <input type="text" id="icon" class="form-control" placeholder="Ex: fa fa-google" name="icon" value="{{$data->icon}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Upload Image size 30px</label>
                                                <input type="file" id="input-file-now" name="image" 
                                                @if($data->image) data-default-file="{{asset ('uploads/images/'. $data->image)}}" @endif class="dropify" />
                                                <p class="font-italic">All the Term's image are same size</p>
                                            </div>
                                        </div>

                                        <div class="form-actions center">
                                            <button type="submit" id="submitBtn" class="btn btn-primary"> Update </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Column selectors table -->
        </div>
    </div>
@endsection
@section('script')

@endsection