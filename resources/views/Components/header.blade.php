<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Tailwind CSS Header</title>
</head>

<body>
    <header class="bg-gray-800 text-white shadow">
        <div class="flex justify-between pt-4 px-8">
            <a href="/">
                <h1 class="flex gap-1 text-4xl items-end text-white font-serif">
                    <p>Bookify</p>
                    <span class="text-lg flex items-center font-mono text-blue-400">Shelves</span>
                </h1>
            </a>
            <nav class="flex items-baseline">
                <a href="/"
                    class="p-2 mb-3 hover:text-blue-500">
                    <span class="ms-3">Home</span>
                </a>
                <a href="#"
                    class="p-2 mb-3 hover:text-blue-500">
                    <span class="ms-3">Books</span>
                </a>
                <a href="#"
                    class="p-2 mb-3 hover:text-blue-500">
                    <span class="ms-3">Author</span>
                </a>
                <a href="#"
                    class="p-2 mb-3 hover:text-blue-500">
                    <span class="ms-3">Contact US</span>
                </a>
                <a href="#"
                    class="p-2 mb-3 hover:text-blue-500">
                    <span class="ms-3">About US</span>
                </a>

            </nav>
            <nav class="flex items-baseline gap-6">
                @php
                    $user = Auth::user();
                @endphp
                @auth
                    <a href="/profile" class=" hover:text-blue-500">Profile</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <x-bladewind::button outline='true' type='secondary' border_width='4'
                            can_submit='true'>Logout</x-bladewind::button>
                    </form>
                @endauth
                @guest
                    <a href="/register" class=" hover:text-blue-500">Register</a>
                    <a href="/login" class=" hover:text-blue-500">Login</a>

                @endguest
            </nav>
        </div>
    </header>
</body>

</html>
