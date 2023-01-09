@extends('layouts.back.master')
@section('title', 'Change Password')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-1">
            </div>
        </div>
        <div class="content-body">
            <div class="row">
            </div>

            <!-- Column selectors table -->
            <section id="basic-form-layouts">
                <div class="row justify-content-center">
                    <div class="col-md-6">
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
                                    <form class="form" method="post" action="{{ route ('changePassword') }}" enctype="multipart/form-data">
                                        @csrf
                                        <h4 class="form-section">Change Password</h4>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="password">New Password <span class="text-danger">* <small>(password must be at least 8 characters)</small></span></label>
                                                
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="feather icon-unlock"></i> Change Password
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
    <script type="text/javascript">
    </script>

@endsection

