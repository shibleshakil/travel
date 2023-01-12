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
                        <form action="#" method="post" enctype="multipart/form-data" class="form">@csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 id="basic-layout-card-center">Hotel Content</h4>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body">
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
                                                        <input type="url" name="youtube_link" id="youtube_link" class="form-control" value="{{old('youtube_link')}}" placeholder="Youtube Video Link">
                                                    </div>
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Feature Image</label>
                                                        <input type="file" id="input-file-now" name="feature_image" class="dropify" />
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Gallery Image</label>
                                                        <input type="file" id="input-file-now" name="feature_image" class="dropify" multiple/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
        
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
@endsection