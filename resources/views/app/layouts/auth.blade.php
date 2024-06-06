<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Minha T-Shirt</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="{{ asset('assets/app/css/app.css') }}"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @if (isset($styles) && is_array($styles) && count($styles) > 0)
            @foreach ($styles as $style)
            <link rel="stylesheet" href="{{$style}}">
            @endforeach
        @endif
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @routes
    </head>
    <body>
        @yield('content')

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="{{ asset('assets/app/js/global.js')}}"></script>
        <script src="{{ asset('assets/app/js/setup-config.js') }}"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        @if (isset($scripts) && is_array($scripts) && count($scripts) > 0)
            @foreach ($scripts as $script)
                <script defer src="{{ $script }}"></script>
            @endforeach
        @endif
    </body>
</html>