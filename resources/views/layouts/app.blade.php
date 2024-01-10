<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--================ CSRF Token ==============================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--================ CSRF Token ==============================================-->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="description" content="Wisdom Power Conference">
    <meta name="description" content="">

    <!-- Favicons -->
    <link href="{{ asset('images/favicon.ico')}}" rel="icon">
    <link href="{{ asset('images/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Roboto:300,400,500,700,900" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/form.css')}}" rel="stylesheet">
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>

    <title>Wisdom Power Conference</title>
</head>
<body>
    <!--=============== this will load in content of the application ===========-->
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    <!--=============== this will load in content of the application ===========-->
</body>
</html>




