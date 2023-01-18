@extends('layouts.back.master')
@section('title', 'Hotel Room')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.index') }}">Hotels</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.edit', [$hotel->id]) }}">Hotel: {{$hotel->name}}</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.room.index', [$hotel->id]) }}">All Rooms</a></li>
                            <li class="breadcrumb-item active"><a href="#">Edit Room : {{$data->name}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Column selectors table -->
                    <section id="column-selectors">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h4 class="card-title" id="basic-layout-card-center">Edit Room: {{$data->name}}</h4>
                            </div>
                        </div>
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
                                    <div class="form-card-header">
                                        <h4 id="basic-layout-card-center">Room Information</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form class="form" action="{{ route ('admin.module.hotel.room.update', [$hotel->id, $data->id]) }}" method="post" enctype="multipart/form-data">@csrf
                                                <div class="form-body">
                                                    @include('admin.module.hotel.room.form')
                                                </div>
        
                                                <div class="form-actions center">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary"> Save Changes </button>
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
        </div>
    </div>
@endsection
@section('script')
@endsection