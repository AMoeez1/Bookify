@extends('layouts.pages')
@section('title', 'Search - Bookify')
@section('content')
    <div class="my-6 flex justify-center">
        <form action="{{route('filter_search')}}" method="get" class="flex items-baseline w-1/3">
            @csrf
            <x-bladewind::input required='true' label="Search Books..." name='search' />
            <x-bladewind::button can_submit='true'>Search</x-bladewind::button>
        </form>
    </div>
    <div class="grid grid-cols-12 ">
        <div class="col-span-2 mx-4 ">
            <h3 class="text-lg font-semibold text-gray-800">Categories</h3>
            <ul class="mt-2">
                <li class="text-blue-500 hover:underline cursor-pointer">Fiction</li>
                <li class="text-blue-500 hover:underline cursor-pointer">Non-Fiction</li>
                <li class="text-blue-500 hover:underline cursor-pointer">Mystery</li>
                <li class="text-blue-500 hover:underline cursor-pointer">Science Fiction</li>
            </ul>
        </div>
        <div class="col-span-10">
            <!-- Book Card -->
            <div class="grid grid-cols-12 gap-4">
                @foreach ($books as $book)
                    <div class="col-span-10 my-4 sm:col-span-5 lg:col-span-4 bg-white shadow-lg rounded-lg overflow-hidden">
                        <img class="w-full h-48 object-contain" src="{{url('storage/'. $book->thumbnail)}}" alt="Book Cover">
                        <div class="p-4">
                            <h2 class="text-xl font-bold text-gray-800">{{$book->name}}</h2>
                            <a href="{{url('user/' . $book->author_id)}}" class="text-md text-gray-600">{{$book->author_name}}</a>
                            <div class="flex items-center mt-1">
                                <span class="text-yellow-500">&#9733;&#9733;&#9733;&#9733;&#9734;</span> <!-- Rating -->
                                <span class="text-gray-500 ml-2">(4.0)</span>
                            </div>
                            <p class="mt-2 text-gray-700">
                                {{$book->description}}
                            </p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">$19.99</span>
                                <a href="{{url('book/'. $book->slug)}}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none">
                                    Read
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
