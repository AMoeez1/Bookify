<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    @vite('resources/css/app.css')

    <title>@yield('title')</title>
    <style>
        .transition-transform {
    transition: transform 0.3s ease;
}

    </style>
</head>
<body class="bg-gray-50">
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            @include('Components.header')
            @yield('content')
        </div>
    </div>
    
</body>
</html>
