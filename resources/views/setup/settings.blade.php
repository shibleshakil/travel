@extends('layouts.back.master')
@section('title', 'General Settings')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Setup</a></li>
                            <li class="breadcrumb-item active"><a href="#">General Settings</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Column selectors table -->
            <section id="column-selectors">
                <div class="row justify-content-md-center">
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
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">General Settings</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route ('admin.setup.appSetting') }}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="app_title">App Title <span class="text-danger">*</span></label>
                                                <input type="text" id="app_title" class="form-control" placeholder="name" 
                                                value="{{$data->app_title}}" name="app_title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="logo">Logo</label><br>
                                                <img src="{{ $data->logo ? asset ('uploads/images/'. $data->logo) : 
                                                    asset ('app-assets/images/logo/stack-logo-dark-big.png')}}" class="logo" alt="">
                                                <br>
                                                <input type="file" id="logo" class="form-control mt-10" name="logo">
                                            </div>
                                            <div class="form-group">
                                                <label for="short_logo">Short Logo</label><br>
                                                <img src="{{ $data->short_logo ? asset ('uploads/images/'. $data->short_logo) : 
                                                    asset ('app-assets/images/logo/stack-logo-small.png')}}" class="short-logo" alt="">
                                                <br>
                                                <input type="file" id="short_logo" class="form-control mt-10" name="short_logo">
                                            </div>
                                            <div class="form-group">
                                                <label for="favicon">Favicon</label><br>
                                                <img src="{{ $data->favicon ? asset ('uploads/images/'. $data->favicon) : 
                                                    asset ('app-assets/images/ico/favicon.ico')}}"class="favicon" alt="">
                                                <br>
                                                <input type="file" id="favicon" class="form-control mt-10" name="favicon">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control"
                                                    placeholder="email" name="email" value="{{$data->email}}">
                                            </div>
                                        </div>

                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check-square-o"></i> Save Changes
                                            </button>
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