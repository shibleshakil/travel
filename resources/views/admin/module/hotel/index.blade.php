@extends('layouts.back.master')
@section('title', 'Hotel')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route ('admin.module.hotel.index') }}">Hotel</a></li>
                            <li class="breadcrumb-item active"><a href="#">All Hotels</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
        </div>
    </div>
@endsection
@section('script')
@endsection