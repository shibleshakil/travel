@extends('layouts.back.master')
@section('title', 'Email Setup')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route ('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Setup</a></li>
                            <li class="breadcrumb-item active"><a href="#">Email Setup</a></li>
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
                                <h4 class="card-title" id="basic-layout-card-center">SMTP Email Configaration</h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route ('admin.setup.emailSetup') }}" method="post" enctype="multipart/form-data">@csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group chkswitch">
                                                        <input type="checkbox" id="smtp_check" class="switchery" value="1" name="smtp_check" 
                                                        @if($data->smtp_check == 1) checked @endif />
                                                        <label for="smtp_check" class="font-medium-2 text-bold-600 ml-1">Use SMTP</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  @if($data->smtp_check == 1) class="row" @else class="row d-none" @endif id="smtp-prop">
                                                <div class="col-md-12">
                                                    <p class="text-danger ml-10">All fields are required</p>
                                                    <div class="form-group">
                                                        <label for="mail_transport">Mail Driver </label>
                                                        <input type="text" id="mail_transport" class="form-control" placeholder="Mail Driver" 
                                                        value="{{$data->mail_transport}}" name="mail_transport" 
                                                        @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_host">Mail Host</label>
                                                        <input type="text" id="mail_host" class="form-control"
                                                            placeholder="Mail Host" name="mail_host" value="{{$data->mail_host}}" 
                                                            @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_port">Mail Port </label>
                                                        <input type="number" id="mail_port" class="form-control phone" placeholder="Mail Port" 
                                                        value="{{$data->mail_port}}" name="mail_port" 
                                                        @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_encryption">Mail Encryption</label>
                                                        <input type="text" id="mail_encryption" class="form-control"
                                                            placeholder="Mail Encryption" name="mail_encryption" value="{{$data->mail_encryption}}" 
                                                            @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_username">Mail Username</label>
                                                        <input type="text" id="mail_username" class="form-control" placeholder="Mail Username" 
                                                        value="{{$data->mail_username}}" name="mail_username" 
                                                        @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_password">Mail Password</label>
                                                        <input type="text" id="mail_password" class="form-control"
                                                            placeholder="Mail Password" name="mail_password" value="{{$data->mail_password}}" 
                                                            @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_from_name">Mail From Name </label>
                                                        <input type="text" id="mail_from_name" class="form-control" placeholder="Mail From Name" 
                                                        value="{{$data->mail_from_name}}" name="mail_from_name" 
                                                        @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mail_from_address">Mail From Address</label>
                                                        <input type="email" id="mail_from_address" class="form-control"
                                                            placeholder="Mail From Address" name="mail_from_address" value="{{$data->mail_from_address}}" 
                                                            @if($data->smtp_check == 1) required @endif>
                                                    </div>
                                                </div>
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
    <script src="{{ asset ('app-assets/js/scripts/forms/switch.js')}}"></script>
@endsection