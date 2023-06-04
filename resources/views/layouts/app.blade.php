<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" href="{{asset('css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.bxslider.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper.css')}}">
    <link rel="stylesheet" href="{{asset('css/swiper.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/media.css')}}">

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body>
<div class="wrapper">
    <!-- Main Header -->
    @include('layouts.menu')

<!-- Content Wrapper. Contains page content -->
    <main>
        <section class="content container">
            @yield('content')
        </section>
    </main>

    <!-- Main Footer -->
    <footer class="main-footer">
        @include('layouts.footer')
    </footer>
</div>

<!-- jQuery plugins/scripts - start -->
<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('js/fancybox/fancybox.js')}}"></script>
<script src="{{asset('js/fancybox/helpers/jquery.fancybox-thumbs.js')}}"></script>
<script src="{{asset('js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('js/swiper.jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/progressbar.min.js')}}"></script>
<script src="{{asset('js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('js/chosen.jquery.min.js')}}"></script>
<script src="{{asset('js/jQuery.Brazzers-Carousel.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="{{asset('js/gmap.js')}}"></script>
<!-- jQuery plugins/scripts - end -->

@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
