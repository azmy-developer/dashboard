<!doctype html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' :'ltr'}}">

<head>

    <meta charset="utf-8" />
    <title>{{__('dash.login')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    @if(app()->getLocale() == 'ar')
        <link href="{{asset('assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    @endif

    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->

</head>

<body>

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        @yield('content')
    </div>
</div>




<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>
</body>

</html>
