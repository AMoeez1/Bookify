<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Tailwind CSS Header</title>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>

<body>
    <header class="bg-gray-800 text-white shadow">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center py-1 md:py-4 px-8">
            <div class="flex">
                <a href="/" class="mb-4 md:mb-0">
                    <h1 class="flex gap-1 text-4xl items-end text-white font-serif">
                        <p>Bookify</p>
                        <span class="text-lg flex items-center font-mono text-blue-400">Shelves</span>
                    </h1>
                </a>
                <div class=" ml-auto">
                    <button class="md:hidden p-2" onclick="toggleMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
            <nav class="hidden md:block" id="mobile-menu">
                <a href="/" class="p-2 mb-3 md:mb-0 hover:text-blue-500">
                    <span>Home</span>
                </a>
                <a href="{{ url('/books') }}" class="p-2 mb-3 md:mb-0 hover:text-blue-500">
                    <span>Books</span>
                </a>
                <a href="#" class="p-2 mb-3 md:mb-0 hover:text-blue-500">
                    <span>Author</span>
                </a>
                <a href="#" class="p-2 mb-3 md:mb-0 hover:text-blue-500">
                    <span>Contact Us</span>
                </a>
                <a href="#" class="p-2 mb-3 md:mb-0 hover:text-blue-500">
                    <span>About Us</span>
                </a>
                <div class="block md:hidden">
                    @php
                        $user = Auth::user();
                    @endphp
                    @auth
                        <a href="/profile" class="hover:text-blue-500">Profile</a>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <x-bladewind::button outline='true' type='secondary' border_width='4'
                                can_submit='true'>Logout</x-bladewind::button>
                        </form>
                    @endauth
                    @guest
                        <a href="/register" class="hover:text-blue-500">Register</a>
                        <a href="/login" class="hover:text-blue-500">Login</a>
                    @endguest
                </div>
            </nav>
            <nav class="md:mt-0 hidden md:block space-x-4">
                @php
                    $user = Auth::user();
                @endphp
                @auth
                    <a href="/profile" class="hover:text-blue-500">Profile</a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <x-bladewind::button outline='true' type='secondary' border_width='4'
                            can_submit='true'>Logout</x-bladewind::button>
                    </form>
                @endauth
                @guest
                    <a href="/register" class="hover:text-blue-500">Register</a>
                    <a href="/login" class="hover:text-blue-500">Login</a>
                @endguest
            </nav>
        </div>
    </header>
</body>

</html>
