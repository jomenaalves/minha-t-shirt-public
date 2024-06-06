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
    <link rel="icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" >
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/tabler-icons.min.css')}}" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather.css')}}" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome.css')}}" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/material.css')}}" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="main-style-link" >
    <link rel="stylesheet" href="{{asset('assets/css/style-preset.css')}}" >

    <!-- CSRF TOKEN-->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    @routes
</head>
  <body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>

    <!-- [ Pre-loader ] End -->
    <div class="auth-main">
        @yield('content')
    </div>
    <!-- [ Main Content ] end -->


    <!-- Required Js -->
    <script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/fonts/custom-font.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.js')}}"></script>
    <script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/sweetalert2.all.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="{{asset('assets/js/setup-config.js')}}"></script>

    <script>
        layout_change('light');
        font_change("Roboto");
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change("preset-5");
    </script>

    @if (isset($scripts) && is_array($scripts) && count($scripts) > 0)
        @foreach ($scripts as $script)
            <script src="{{ $script }}"></script>
        @endforeach
    @endif

</body>
</html>
