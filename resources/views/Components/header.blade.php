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
            <nav class="flex items-baseline gap-6">
                @php
                    $user = Auth::user();
                @endphp
                @auth
                <a href="/profile" class=" hover:text-blue-500">Profile</a>
                
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <x-bladewind::button outline='true' type='secondary' border_width='4' can_submit='true'>Logout</x-bladewind::button>
                </form>
                {{-- <x-bladewind::dropmenu>

                <x-slot:trigger>
                    <div class="flex space-x-2 items-center rounded-md">
                        <div class="grow">
                            <x-bladewind::avatar image="/assets/...jpg" />
                        </div>
                        <div>
                            <x-bladewind::icon name="chevron-down" class="!h-4 !w-4" />
                        </div>
                    </div>
                </x-slot:trigger>
            
                <x-bladewind::dropmenu-item header="true">
                    <div class="grow">
                        <div><strong>Jane A. Doe</strong></div>
                        <div class="text-sm">@jane-the-coder</div>
                        <div class="text-sm">jane@bladewindui.com</div>
                    </div>
                </x-bladewind::dropmenu-item>
            
                <x-bladewind::dropmenu-item icon="pencil-square">
                    Edit Profile
                </x-bladewind::dropmenu-item>
                <x-bladewind::dropmenu-item icon="trash" icon_css="!text-red-300">
                    <span class="text-red-500">Delete Profile</span>
                </x-bladewind::dropmenu-item>
            
                <x-bladewind::dropmenu-item divider />
            
                <x-bladewind::dropmenu-item icon="computer-desktop">
                    Your Repositories
                </x-bladewind::dropmenu-item>
                <x-bladewind::dropmenu-item icon="briefcase">
                    Your Projects
                </x-bladewind::dropmenu-item>
                <x-bladewind::dropmenu-item icon="building-office">
                    Your Organizations
                </x-bladewind::dropmenu-item>
                <x-bladewind::dropmenu-item icon="star">
                    Your Stars
                </x-bladewind::dropmenu-item>
            
                <x-bladewind::dropmenu-item divider />
            
                <x-bladewind::dropmenu-item hover="false">
                    <x-bladewind::button color="purple" radius="small" size="small" class="w-full">
                        Sign Out
                    </x-bladewind::button>
                </x-bladewind::dropmenu-item>
            
            </x-bladewind::dropmenu> --}}
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
