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
                            <li class="breadcrumb-item active"><a href="#">Room Management</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h4 class="card-title" id="basic-layout-card-center">Room Management</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route ('admin.module.hotel.edit', ['id'=>$hotel->id])}}" class="btn btn-primary"><i class="fa fa-hand-o-left"></i> Back To Hotel</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <!-- Column selectors table -->
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
                                    <div class="form-card-header">
                                        <h4 id="basic-layout-card-center">Add Room</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form class="form" action="{{ route ('admin.module.hotel.room.store', [$hotel->id]) }}" method="post" enctype="multipart/form-data">@csrf
                                                <div class="form-body">
                                                    @include('admin.module.hotel.room.form')
                                                </div>
        
                                                <div class="form-actions center">
                                                    <button type="submit" id="submitBtn" class="btn btn-primary"> Add Room </button>
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
                <div class="col-lg-6">
                    <section id="basic">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="form-card-header">
                                        <h4 id="basic-layout-card-center">Room List</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Name</th>
                                                            <th>Number</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (sizeof ($datas) > 0)
                                                            @foreach ($datas as $data)
                                                                <tr>
                                                                    <td>{{++$sl}}</td>
                                                                    <td>{{$data->name}}</td>
                                                                    <td>{{$data->number ? $data->number : 0}}</td>
                                                                    <td>{{$data->price ? $data->price : 0}}</td>
                                                                    <td>
                                                                        <a href="{{ route ('admin.module.hotel.room.edit', ['hotel'=>$data->hotel_id, 'id'=>$data->id])}}">
                                                                            <button type="button" title="Edit" class="btn btn-primary btn-sm">
                                                                            <i class="fa fa-pencil-square"></i> Edit</button>
                                                                        </a>
                                                                        <button type="button" class="btn btn-danger btn-sm btn-icon" title="Delete Room" 
                                                                            onclick="deleteData('{{ route('admin.module.hotel.room.delete', [$data->id]) }}')">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                    <tfoot class="display-hidden">
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Name</th>
                                                            <th>Number</th>
                                                            <th>Price</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection