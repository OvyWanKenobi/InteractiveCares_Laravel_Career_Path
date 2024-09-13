<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASHIQUR RAHMAN</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    {{-- 
    <link rel="stylesheet" href="plugins/font-awesome/fontawesome.min.css"> --}}

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- MAIN STYLE -->
    <link rel="stylesheet" href="{{ asset('css/marvel-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/devrick-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inbio-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-style.css') }}">
    <!--

Tooplate 2115 Marvel

https://www.tooplate.com/view/2115-marvel

-->
</head>

<body>


    @include('includes.header')
    @yield('content')
    @include('includes.footer')



    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Headroom.js') }}"></script>
    <script src="{{ asset('js/jQuery.headroom.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/smoothscroll.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
