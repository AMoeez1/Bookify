@extends('layouts.pages')

@section('title', 'Profile - ' . Auth::user()->name)
@php
    use App\UserRole;
    $user = Auth::user();
@endphp
<style>
    svg.size-6.inline-block.modal-icon.-mt-1.text-green-600.success {
        height: 20px
    }

    svg.size-6.inline-block.modal-icon.-mt-1.text-red-600.error {
        height: 20px;
    }

    .w-full.bw-alert.animate__animated.animate__fadeIn.rounded-md.flex.p-3.bg-green-200\/80.text-green-600.w-80 {
        padding: 10px 8px 8px 10px;
        font-size: 13px;
        display: flex;
        align-items: baseline;
    }

    .w-full.bw-alert.animate__animated.animate__fadeIn.rounded-md.flex.p-3.bg-red-200\/80.text-red-600 {
        padding: 10px 8px 8px 10px;
        font-size: 13px;
        display: flex;
        align-items: baseline;
    }

    img.rounded-md {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
</style>
@section('content')
    <section class="py-3 md:py-5 xl:py-5">
        @if (session('Res'))
            <div class="flex justify-center transition-opacity duration-500 opacity-100" id="alert">
                <x-bladewind::alert type="success" size='tiny' class=" w-80">
                    {{ session('Res') }}
                </x-bladewind::alert>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="flex justify-center transition-opacity duration-500 opacity-100" id="error">
                    <x-bladewind::alert type="error" class="w-80">
                        {{ $error }}
                    </x-bladewind::alert>
                </div>
            @endforeach
        @endif
        <div class="container mx-auto">
            <x-bladewind::tab-group name="sys-blue-tab" style="system">
                <x-slot:headings>
                    <x-bladewind::tab-heading name="profile" active='true' label="Profile" />
                    <x-bladewind::tab-heading name='edit' label='Edit Profile' />

                    @if ($user->role == UserRole::Author)
                        <x-bladewind::tab-heading name='add_book' label='Add Book' />
                        <x-bladewind::tab-heading name='feat' label='Featured Books' />
                        <x-bladewind::tab-heading name='books' label='Books Published' />
                    @else
                        <x-bladewind::tab-heading name='author' label='Switch To Author' />
                    @endif
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
                        <p class="mb-3">{{ $user->about == '' ? 'No About Added.' : $user->about }}</p>
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
                            @if ($user->image)
                                <div class="mb-4 w-32 rounded-full">
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
                                    <input type="file" id="imageUpload" name="image" style="display: none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>
                                <a href="{{ url('/remove/profile') }}"
                                    class="border-2 border-blue-400 text-xs p-2 rounded-lg mx-0">Remove Current Profile</a>
                                <h5 class="mt-6 mb-4 font-semibold">About</h5>
                            @else
                                <div class="mb-4 w-32">
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
                                    <input type="file" id="imageUpload" name="image" style="display: none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>
                                <h5 class="my-3 font-semibold">About</h5>
                            @endif
                            <x-bladewind::textarea label="About" name='about' selected_value='{{ $user->about }}' />
                            <h5 class="mb-3 font-semibold">Profile</h5>
                            <div class="">
                                <x-bladewind::input label='Full Name' class="w-1/2" name='name'
                                    selected_value='{{ $user->name }}' />
                                <x-bladewind::button class="mb-4 w-1/2 text-start" outline='true' disabled="true"
                                    type="secondary">
                                    Role: {{ $user->role }}
                                </x-bladewind::button>
                                <x-bladewind::input label='Email' class="w-1/2" name='email'
                                    selected_value='{{ $user->email }}' />
                            </div>
                            <div class="mt-6 flex gap-4 justify-end items-center">
                                <h2 class="text-lg font-semibold">Social Links:</h2>
                                <div class="flex space-x-4">
                                    <a href="#" class="text-blue-500 hover:underline">Twitter</a>
                                    <a href="#" class="text-blue-500 hover:underline">LinkedIn</a>
                                    <a href="#" class="text-blue-500 hover:underline">GitHub</a>
                                </div>
                            </div>
                            <x-bladewind::button can_submit='true'>Edit Profile</x-bladewind::button>
                        </form>
                    </x-bladewind::tab-content>
                    @if ($user->role === UserRole::Author)
                        <x-bladewind::tab-content name="add_book">
                            <form action="{{ route('add_book') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex gap-2">
                                    <div class="w-1/2">
                                        <x-bladewind::button class="mb-4 w-full text-start" outline='true'
                                            disabled="true" type="secondary">
                                            Author Id: {{ $user->id }}
                                        </x-bladewind::button>
                                    </div>
                                    <div class="w-1/2">
                                        <x-bladewind::button class="mb-4 w-full text-start" outline='true'
                                            disabled="true" type="secondary">
                                            Author Name: {{ $user->name }}
                                        </x-bladewind::button>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-1/2">
                                        <x-bladewind::input required="true" name='name' label="Book Name" />
                                    </div>

                                    <div class="w-1/2">
                                        <x-bladewind::input name='feat' label="Featured Author" />
                                    </div>
                                </div>
                                <x-bladewind::textarea required="true" name='description' label="Description" />
                                <div class="flex gap-2">
                                    <div class="w-1/2">
                                        <x-bladewind::filepicker placeholder="Add Thumbnail / Cover Picture"
                                            name="thumbnail" />
                                    </div>
                                    <div class="w-1/2">
                                        <x-bladewind::filepicker name="file" placeholder="Upload a PDF"
                                            max_file_size="1" accepted_file_types=".pdf" />
                                    </div>
                                </div>
                                <x-bladewind::button can_submit='true'>Add Book</x-bladewind::button>
                            </form>
                        </x-bladewind::tab-content>
                        <x-bladewind::tab-content name="feat">
                            <p>Featured Books</p>
                        </x-bladewind::tab-content>
                        <x-bladewind::tab-content name="books">
                            <x-bladewind::table>
                                <x-slot name="header">
                                    <th>Book Id</th>
                                    <th>Book Name</th>
                                    <th>Author</th>
                                    <th>Author Id</th>
                                    <th>Read or Download</th>
                                    <th>Edit</th>
                                </x-slot>
                                @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->author_name }}</td>
                                    <td>{{ $book->author_id }}</td>
                                    <td><a href="{{url('book/'. $book->slug)}}">{{$book->slug}}</a></td>
                                    <td><a href="{{url('book/edit/'. $book->slug)}}">Edit</a></td>
                                </tr>
                                @endforeach
                            </x-bladewind::table>
                        </x-bladewind::tab-content>
                    @else
                        <x-bladewind::tab-content name="author">
                            <p>Switch to Author</p>
                        </x-bladewind::tab-content>
                    @endif
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

            setTimeout(function() {
                const alert = document.getElementById('alert');
                const error = document.getElementById('error')
                if (alert || error) {
                    if (alert) {
                        alert.classList.remove('opacity-100');
                        alert.classList.add('opacity-0');
                    }
                    if (error) {
                        error.classList.remove('opacity-100');
                        error.classList.add('opacity-0');
                    }
                    setTimeout(function() {
                        if (alert) {
                            alert.classlist.add('hidden')
                        }
                        if (error) {
                            error.classlist.add('hidden')
                        }
                    }, 1000)
                }
            }, 5000);
        </script>
