@extends('layouts.back.master')
@section('title', 'Edit Profile')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
            </div>
        </div>
        <div class="content-body">

            <!-- Column selectors table -->
            <section id="basic-form-layouts">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
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
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form clas="form" action="{{ route('updateProfile')}}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="media">
                                            <a href="javascript: void(0);">
                                                <img src="{{Auth()->user()->image ? asset ('uploads/images/'.Auth()->user()->image) 
                                                    : asset ('app-assets/images/portrait/small/avatar-s-1.png') }}" 
                                                    class="rounded mr-75" alt="profile image" height="64" width="64">
                                            </a>
                                            <div class="media-body mt-75">
                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                    <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                                                    <input type="file" id="account-upload" hidden name="image">
                                                    <button class="btn btn-sm btn-secondary ml-50">Reset</button>
                                                </div>
                                                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 800kB</small></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{$data->first_name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$data->last_name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="email">E-mail</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$data->email}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="mobile">Phone number</label>
                                                        <input type="number" class="form-control phone" id="mobile" name="mobile" placeholder="mobile" value="{{$data->mobile}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save changes</button>
                                                <button type="button" onclick="(location.reload())" class="btn btn-light">Cancel</button>
                                            </div>
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
