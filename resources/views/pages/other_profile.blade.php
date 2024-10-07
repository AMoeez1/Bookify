@extends('layouts.pages')

@section('title', 'Profile - ' . $user->name)
@php
    use App\UserRole;
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
                    <x-bladewind::tab-content name="feat">
                        @if ($books)
                        <x-bladewind::empty-state message="<b>{{$user->name}}</b> has not been featured in any book yet!">
                        </x-bladewind::empty-state>
                    @else
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
                                    <td><a href="{{ url('book/' . $book->slug) }}">{{ $book->slug }}</a></td>
                                    <td><a href="{{ url('book/edit/' . $book->slug) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </x-bladewind::table>
                    @endif
                    </x-bladewind::tab-content>
                    <x-bladewind::tab-content name="books">
                        @if ($books)
                        <x-bladewind::empty-state message="{{$user->name}} has not published any book yet!">
                        </x-bladewind::empty-state>
                    @else
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
                                    <td><a href="{{ url('book/' . $book->slug) }}">{{ $book->slug }}</a></td>
                                    <td><a href="{{ url('book/edit/' . $book->slug) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </x-bladewind::table>
                    @endif
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
