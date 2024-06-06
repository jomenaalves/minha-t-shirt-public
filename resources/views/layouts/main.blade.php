<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') | Minha T-Shirt</title>
        <!-- [Meta] -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="codedthemes">

        <!-- [Favicon] icon -->
        <link rel="icon" href="{{asset('/assets/images/favicon.svg')}}" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link">
        <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fonts/feather.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fonts/material.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="main-style-link">
        <link rel="stylesheet" href="{{asset('assets/css/style-preset.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        
        @if (isset($styles) && is_array($styles) && count($styles) > 0)
            @foreach ($styles as $style)
            <link rel="stylesheet" href="{{$style}}">
            @endforeach
        @endif

    </head>

    <body >
        @routes
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>

        @include('includes.sidebar')
        @include('includes.header')

        @yield('content')
        
        @yield('modals')

        @include('includes.footer')

        <script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/fonts/custom-font.js')}}"></script>
        <script src="{{asset('assets/js/pcoded.js')}}"></script>
        <script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
              
        <script src="{{asset('/assets/js/setup-config.js')}}"></script>
        <script src="{{asset('/assets/js/global.js')}}"></script>
        
        <script>
            preset_change("preset-5");
            layout_change('light');
            font_change("Roboto");
            layout_rtl_change('false');
        </script>
        
        @if (isset($scripts) && is_array($scripts) && count($scripts) > 0)
            @foreach ($scripts as $script)
                <script defer src="{{ $script }}"></script>
            @endforeach
        @endif
    </body>
</html>
