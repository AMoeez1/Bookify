<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    @vite('resources/css/app.css')

    <title>@yield('title')</title>
    <style>
        .transition-transform {
    transition: transform 0.3s ease;
}

    </style>
</head>
<body>
    <div class="grid grid-cols-12">
        <div class="col-span-0  md:col-span-2">
            {{-- Sidebar --}}
            @include('Components.sidebar')
        </div>
        <div class="col-span-12 md:col-span-10">
            @yield('content')
        </div>
    </div>
    
</body>
</html>
