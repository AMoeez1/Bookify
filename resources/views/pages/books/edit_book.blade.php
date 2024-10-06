@extends('layouts.pages')
@section('title', $book->name . ' - Edit')
@section('content')
    <div class="my-4">
        <x-bladewind::tab-group name="sys-blue-tab" style="system">
            <x-slot:headings>
                <x-bladewind::tab-heading name="profile" active="true" label="Book Details" />
                <x-bladewind::tab-heading name="feat" label="Edit Book" />
            </x-slot:headings>

            <x-bladewind::tab-body>
                <x-bladewind::tab-content name="profile" active="true">
                    <div class="container mx-auto px-4 py-8">
                        <div class="flex flex-wrap -mx-4">
                            <!-- Product Images -->
                            <div class="w-full md:w-1/2  px-4 mb-8">
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Product"
                                    class="w-1/2 h-60 object-contain rounded-lg shadow-md mb-4" id="mainImage">
                            </div>

                            <!-- Product Details -->
                            <div class="w-full md:w-1/2 px-4">
                                <h2 class="text-3xl font-bold mb-2">{{ $book->name }}</h2>
                                <p class="text-gray-600 mb-4">Written by: <a href="{{ url('user/' . $book->author_id) }}"
                                        class="underline">{{ $book->author_name }}</a></p>
                                <p class="text-gray-600 mb-4">Featured Author: {{ $book->feat_author ?? 'No Featured' }}</p>
                                <div class="mb-4">
                                    <span class="text-2xl font-bold mr-2">$349.99</span>
                                    <span class="text-gray-500 line-through">$399.99</span>
                                </div>
                                <p class="text-gray-700 mb-6">Description: {{ $book->description }}</p>

                            </div>
                        </div>
                    </div>
                </x-bladewind::tab-content>

                <x-bladewind::tab-content name="feat">
                    <form action="{{ route('edit_book', $book->slug) }}" method="POST" enctype="multipart/form-data">
                        <div class="container mx-auto px-4 py-8">
                            <div class="flex flex-wrap -mx-4">
                                <!-- Product Images -->
                                <div class="w-full md:w-1/2 px-4 mb-8">
                                    <label for="imageUpload" class="cursor-pointer">
                                        <div
                                            class="flex justify-center relative w-1/2 object-contain rounded-lg overflow-hidden">
                                            <img class="object-contain w-1/2 h-60 transition-opacity rounded-lg shadow-md duration-200 ease-in-out hover:opacity-50"
                                                src="{{ asset('storage/' . $book->thumbnail) }}" 
                                                 alt="Profile Image" />
                                            <div
                                                class="absolute inset-0 flex flex-col justify-center items-center text-white opacity-0 transition-opacity duration-200 ease-in-out hover:opacity-100">
                                                <span class="pb-2">
                                                    <i class="material-icons text-2xl">add_a_photo</i>
                                                </span>
                                                <span class="uppercase text-xl w-1/2 text-center font-bold">Change
                                                    Picture</span>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" id="imageUpload" name="thumbnail" style="display: none;"
                                        accept="image/*" onchange="previewImage(event)">
                                </div>

                                <!-- Product Details -->
                                <div class="w-full md:w-1/2 px-4">
                                    @csrf
                                    <x-bladewind::input name='name' prefix="Book Name: "
                                        selected_value='{{ $book->name }}' required='true' />
                                    <x-bladewind::button class="mb-4 w-full text-start" outline='true' disabled="true"
                                        type="secondary">
                                        Book Id: {{ $book->id }}</x-bladewind::button>
                                    <x-bladewind::button class="mb-4 w-full text-start" outline='true' disabled="true"
                                        type="secondary" uppercasing='false' >
                                        Book Slug: {{ $book->slug }}
                                    </x-bladewind::button>
                                    <x-bladewind::button class="mb-4 w-full text-start" outline='true' disabled="true"
                                        type="secondary">
                                        Author Name: {{ $book->author_name }}
                                    </x-bladewind::button>
                                    <x-bladewind::input name="feat_author" prefix="Featured Author: "
                                        selected_value='{{ $book->feat_author }}' required='true' />
                                    <x-bladewind::input name="description" prefix="Description: "
                                        selected_value='{{ $book->description }}' required='true' />
                                    <x-bladewind::filepicker name="file" placeholder="Upload a PDF" required='true'
                                        selected_value="{{ $book->file }}" max_file_size="1"
                                        accepted_file_types=".pdf" />

                                    <div class="flex space-x-4 mb-6">
                                        <x-bladewind::button can_submit='true'>Edit</x-bladewind::button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </x-bladewind::tab-content>

            </x-bladewind::tab-body>
        </x-bladewind::tab-group>
    </div>
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
