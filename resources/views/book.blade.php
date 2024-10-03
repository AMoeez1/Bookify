@extends('layouts.pages')
@section('title', 'Book - ' . $book->name)
@section('content')

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Product Images -->
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <img src="{{asset('storage/'. $book->thumbnail)}}" alt="Product" class="w-1/2 object-cover rounded-lg shadow-md mb-4" id="mainImage">
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-3xl font-bold mb-2">{{$book->name}}</h2>
                    <p class="text-gray-600 mb-4">Written by: {{$book->author_name}}</p>
                    <p class="text-gray-600 mb-4">Featured Author: {{$book?->feat_author ?? 'No Featured'}}</p>
                    <div class="mb-4">
                        <span class="text-2xl font-bold mr-2">$349.99</span>
                        <span class="text-gray-500 line-through">$399.99</span>
                    </div>
                    <p class="text-gray-700 mb-6">Description: {{$book->description}}</p>

                    <div class="flex space-x-4 mb-6">
                        <button
                            class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Download
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <canvas id="pdf-canvas" class="w-full md:w-1/2"></canvas>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    const url = "{{ asset('storage/' . $book->file) }}";
    const loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(pdf => {
        pdf.getPage(1).then(page => {
            const viewport = page.getViewport({
                scale: 5
            });
            const canvas = document.getElementById('pdf-canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: context,
                viewport: viewport,
            };
            page.render(renderContext);
        });
    });
    function changeImage(src) {
                document.getElementById('mainImage').src = src;
            }
</script>
