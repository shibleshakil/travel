<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{$setting->app_title}}</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting->favicon ? asset ('uploads/images/'.$setting->favicon) : asset ('app-assets/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset ('fonts/icofont/icofont.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/summernote.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/dropify.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- link(rel='stylesheet', type='text/css', href=app_assets_path+'/css'+rtl+'/pages/users.css')-->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/style.css?v1.3')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">
    <input type="hidden" id="csrfToken" value="{{ csrf_token() }}">

    <!-- BEGIN: Header-->
    @include('layouts.back.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.back.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        @yield('content')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.back.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset ('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset ('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{ asset ('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{ asset ('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset ('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset ('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"></script>
    <script src="{{ asset ('app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
    <script src="{{ asset ('assets/js/dropify.min.js')}}"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset ('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset ('app-assets/js/core/app.js')}}"></script>
    <script src="{{ asset ('assets/js/datatable.js?v1.1')}}"></script>
    <script src="{{ asset ('assets/js/dropify-init.js?v1.1')}}"></script>
    <script src="{{ asset ('assets/js/common.js?v1.4')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    @yield('script')
    <!-- END: Page JS-->
    <script>
        $(".form").submit( function (){
            $("#submitBtn").attr("disabled", true);
            return true;
        });

        $(".select2").select2();
        $('.summernote').summernote({
            placeholder: '',
            blockquoteBreakingLevel: 2,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            tabsize: 2,
            minHeight: 150
        });
    </script>

</body>
<!-- END: Body-->

</html>