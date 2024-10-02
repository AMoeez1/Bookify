@extends('Layouts.pages')
@section('title', 'Home - Bookify Shelves')
@section('content')
    <style>
        svg.size-6.inline-block.modal-icon.-mt-1.text-red-600.error {
            height: 20px;
        }

        .w-full.bw-alert.animate__animated.animate__fadeIn.rounded-md.flex.p-3.bg-red-200\/80.text-red-600.w-80 {
            padding: 10px 8px 8px 10px;
            font-size: 13px;
            display: flex;
            align-items: baseline;
        }
    </style>
    <!-- Hero Section -->
    <section class="bg-center h-72 md:h-96"
        style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdxLtKhAukpF1QK__ZI5P-X3Smxf7dDyjNJg&s');">
        <div class=" bg-black bg-opacity-50">
            @if (session('Res'))
                <div class="transition-opacity duration-500 opacity-100 absolute left-1/2 top-3" id="alert">
                    <x-bladewind::alert type="error" size='tiny' class=" w-80">
                        {{ session('Res') }}
                    </x-bladewind::alert>
                </div>
            @endif
            <div class="text-center content-center h-full">
                <div class="flex justify-center">
                    <h1 class="flex gap-1 text-5xl md:text-6xl text-white mb-6 font-serif">
                        <p>Bookify</p>
                        <span class="md:text-3xl text-2xl flex items-end font-mono text-blue-500">Shelves</span>
                    </h1>
                </div>
                <h2 class="text-white text-3xl md:text-5xl font-bold">Unlock the World of Stories</h2>
                <h3 class="text-white text-xl md:text-3xl font-bold">Read & download Books in PDF</h3>
            </div>
        </div>
    </section>

    <!-- Search Bar -->
    <div class="container mx-auto py-6">
        <div class="flex justify-center">
            <input type="text" placeholder="Search for your next great read..."
                class="border border-gray-300 rounded-lg p-2 w-1/2 md:w-1/3" />
        </div>
    </div>

    <!-- Featured Sections -->
    <div class="container mx-auto py-6">
        <h3 class="text-xl font-bold mb-4">This Week’s Bestsellers</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Example Book Item -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="book-cover-url.jpg" alt="Book Title" class="w-full h-48 object-cover rounded-md mb-2">
                <h4 class="font-semibold">Book Title</h4>
                <p class="text-gray-600">Author Name</p>
                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Buy Now</button>
            </div>
            <!-- Repeat for more books -->
        </div>

        <h3 class="text-xl font-bold mb-4 mt-6">Just Arrived</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Example Book Item -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="book-cover-url.jpg" alt="Book Title" class="w-full h-48 object-cover rounded-md mb-2">
                <h4 class="font-semibold">Book Title</h4>
                <p class="text-gray-600">Author Name</p>
                <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded">Download Now</button>
            </div>
            <!-- Repeat for more books -->
        </div>

        <h3 class="text-xl font-bold mb-4 mt-6">Explore Categories</h3>
        <div class="flex space-x-4">
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Fiction</h4>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Non-Fiction</h4>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Mystery</h4>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Romance</h4>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Science Fiction</h4>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4 text-center">
                <h4 class="font-semibold">Fantasy</h4>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="container mx-auto py-6">
        <h3 class="text-xl font-bold mb-4">What Readers Are Saying</h3>
        <div class="bg-gray-100 p-4 rounded-lg">
            <p class="italic">“Bookify Shelves is my go-to place for all my reading needs!” - Reader Name</p>
        </div>
    </div>

    <!-- Newsletter Signup -->
    <div class="container mx-auto py-6 text-center">
        <h3 class="text-xl font-bold mb-4">Stay Updated!</h3>
        <p>Join our newsletter for exclusive offers and updates on new arrivals.</p>
        <input type="email" placeholder="Your Email" class="border border-gray-300 rounded-lg p-2 w-1/2 md:w-1/3 mt-2" />
        <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Subscribe</button>
    </div>

@endsection

<script>
    setTimeout(function() {
        const alert = document.getElementById('alert');
        if (alert) {
            alert.classList.remove('opacity-100');
            alert.classList.add('opacity-0');
            setTimeout(function() {
                alert.classlist.add('hidden')
            }, 1000)
        }
    }, 5000);
</script>
