<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-gray-800 min-h-screen flex flex-col items-center justify-center">
        <div class="flex justify-center">
            <h1 class="flex gap-1 text-6xl text-white my-10 font-serif">
                <p>Bookify</p>
                <span class="text-3xl flex items-end font-mono text-blue-400">Shelves</span>
            </h1>
        </div>
        @yield('content')
    </div>
</body>

</html>
