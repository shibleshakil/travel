@extends('layouts.back.master')
@section('title', 'Location Details')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.location.index') }}">Location</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="column-selectors">
                <div class="row">
                    <div class="col-md-12">
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
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">Edit {{$data->name}}</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route ('admin.module.location.update', ['id'=>$data->id, 'slug'=>$data->slug]) }}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    @include('admin.location.form')
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Feature Image</label>
                                                        <input type="file" id="input-file-now" name="feature_image" @if($data->feature_image) data-default-file="{{asset ('uploads/images/'. $data->feature_image)}}" @endif class="dropify" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Publish</label>
                                                        <div class="input-group">
                                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                                <input type="radio" @if($data->status == 'Publish') checked @endif class="custom-control-input" id="Publish" name="status" value="Publish">
                                                                <label class="custom-control-label" for="Publish">Publish</label>
                                                            </div>
                                                            <div class="d-inline-block custom-control custom-radio">
                                                                <input type="radio" @if($data->status == 'Draft') checked @endif class="custom-control-input" id="Draft" name="status" value="Draft">
                                                                <label class="custom-control-label" for="Draft">Draft</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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