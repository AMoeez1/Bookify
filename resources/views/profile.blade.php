@extends('layouts.pages')

@section('title', 'Profile - ' . Auth::user()->name)
<?php
$user = Auth::user();
?>

@section('content')

    <section class="py-3 md:py-5 xl:py-8">
        <div class="container mx-auto">
            <x-bladewind::tab-group name="sys-blue-tab" style="system">
                <x-slot:headings>
                    <x-bladewind::tab-heading name="profile" active='true' label="Profile" />
                    <x-bladewind::tab-heading name='edit' label='Edit Profile' />
                    <x-bladewind::tab-heading name='feat' label='Featured Books' />
                    <x-bladewind::tab-heading name='books' label='Books Published' />
                </x-slot:headings>

                <x-bladewind::tab-body>
                    <x-bladewind::tab-content name="profile" active="true">
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture"
                                class="w-32 h-32 rounded-full border-2 border-gray-300 my-4 object-cover">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Profile Picture"
                                class="w-32 h-32 rounded-full border-2 border-gray-300 my-4">
                        @endif
                        <h5 class="mb-3 font-semibold">About</h5>
                        <p class="text-lg mb-3">{{$user->about}}</p>
                        <h5 class="mb-3 font-semibold">Profile</h5>
                        <div>
                            <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                            <p class="text-gray-600">Role: {{ $user->role }}</p>
                            <p class="text-gray-500">Email: {{ $user->email }}</p>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-lg font-semibold">Social Links</h2>
                            <div class="flex space-x-4">
                                <a href="#" class="text-blue-500 hover:underline">Twitter</a>
                                <a href="#" class="text-blue-500 hover:underline">LinkedIn</a>
                                <a href="#" class="text-blue-500 hover:underline">GitHub</a>
                            </div>
                        </div>
                    </x-bladewind::tab-content>

                    <x-bladewind::tab-content name="edit">
                        <form action="{{ route('edit_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <x-bladewind::alert type="error">
                                        {{ $error }}
                                    </x-bladewind::alert>
                                @endforeach
                            @endif
                            @if ($user->image)
                                <div class="mb-4 col-span-3">
                                    <label for="imageUpload" class="cursor-pointer">
                                        <div
                                            class="relative w-32 h-32 rounded-full overflow-hidden bg-gray-900 hover:bg-opacity-50">
                                            <img class="object-cover w-full h-full transition-opacity duration-200 ease-in-out hover:opacity-50"
                                                src="{{ asset('storage/' . $user->image) }}" width="150" height="150"
                                                alt="Profile Image" />
                                            <div
                                                class="absolute inset-0 flex flex-col justify-center items-center text-white opacity-0 transition-opacity duration-200 ease-in-out hover:opacity-100">
                                                <span class=" pb-2">
                                                    <i class="fas fa-camera text-xl"></i>
                                                </span>
                                                <span class="uppercase text-xs w-1/2 text-center">Change Picture</span>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" id="imageUpload" name="image" required style="display: none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>
                            @else
                                <div class="mb-4 col-span-3">
                                    <label for="imageUpload" class="cursor-pointer">
                                        <div
                                            class="relative w-32 h-32 rounded-full overflow-hidden bg-gray-900 hover:bg-opacity-50">
                                            <img class="object-cover w-full h-full transition-opacity duration-200 ease-in-out hover:opacity-50"
                                                src="https://via.placeholder.com/150" width="150" height="150"
                                                alt="Profile Image" />
                                            <div
                                                class="absolute inset-0 flex flex-col justify-center items-center text-white opacity-0 transition-opacity duration-200 ease-in-out hover:opacity-100">
                                                <span class=" pb-2">
                                                    <i class="fas fa-camera text-xl"></i>
                                                </span>
                                                <span class="uppercase text-xs w-1/2 text-center">Change Picture</span>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" id="imageUpload" name="image" required style="display: none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>
                            @endif
                            <h5 class="mb-3 font-semibold">About</h5>
                            <x-bladewind::input label="About" name='about' selected_value='{{ $user->about }}' />
                            <h5 class="mb-3 font-semibold">Profile</h5>
                            <div>
                                <x-bladewind::input label='Full Name' name='name' selected_value='{{ $user->name }}' />
                                <x-bladewind::button class="mb-4 w-full text-start" outline='true' disabled="true"
                                    type="secondary">
                                    Role: {{ $user->role }}
                                </x-bladewind::button>
                                <x-bladewind::input label='Email' name='email' selected_value='{{ $user->email }}' />
                            </div>
                            <div class="mt-6">
                                <h2 class="text-lg font-semibold">Social Links</h2>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-blue-500 hover:underline">Twitter</a>
                                    <a href="#" class="text-blue-500 hover:underline">LinkedIn</a>
                                    <a href="#" class="text-blue-500 hover:underline">GitHub</a>
                                </div>
                            </div>
                            <x-bladewind::button can_submit='true'>Edit Profile</x-bladewind::button>
                        </form>
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="feat">
                        <p>Featured Books</p>
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="books">
                        <p>Books Published</p>
                    </x-bladewind::tab-content>
                </x-bladewind::tab-body>

            </x-bladewind::tab-group>
        @endsection
        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                const imgElement = document.querySelector('label img');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
