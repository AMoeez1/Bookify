@extends('layouts.pages')
@section('title', 'Book - ' . $book->name)
@section('content')

<style>
    canvas{
        width: 600px;
        border: 2px solid lightgray;
    }

</style>

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Product Images -->
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <img src="{{asset('storage/'. $book->thumbnail)}}" alt="Product" class="w-1/2 object-contain rounded-lg shadow-md mb-4" id="mainImage">
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-3xl font-bold mb-2">{{$book->name}}</h2>
                    <p class="text-gray-600 mb-4">Written by: <a href="{{url('user/'. $book->author_id)}}" class="underline">{{$book->author_name}}</a></p>
                    <p class="text-gray-600 mb-4">Featured Author: {{$book?->feat_author ?? 'No Featured'}}</p>
                    <div class="mb-4">
                        <span class="text-2xl font-bold mr-2">$349.99</span>
                        <span class="text-gray-500 line-through">$399.99</span>
                    </div>
                    <p class="text-gray-700 mb-6">Description: {{$book->description}}</p>

                    <div class="flex space-x-4 mb-6">
                        @if (auth()->id() === $book->author_id)
                            <a href="{{url('book/edit/' . $book->slug)}}" class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit Book</a>
                            @else
                            <button
                            class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Download
                        </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- <canvas id="pdf-canvas" class="w-full md:w-1/2"></canvas> --}}
    
        <div id="canvas-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4" ></div>
    
@endsection

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    const url = "{{ asset('storage/' . $book->file) }}";
    const btn = document.getElementById('page');
    let page = 1;
    btn.addEventListener('click', function(){
        const nextpage = page +1;
    })
    const loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(pdf => {
        pdf.getPage(nextpage).then(page => {
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
</script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const url = "{{ asset('storage/' . $book->file) }}";
        let pdfDoc = null;

        // Load the PDF document
        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdfDoc = pdf;
            renderAllPages();
        });

        // Render all pages
        function renderAllPages() {
            const canvasContainer = document.getElementById('canvas-container');
            canvasContainer.innerHTML = ''; 

            const promises = [];
            for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
                promises.push(renderPage(pageNum, canvasContainer));
            }

            Promise.all(promises).then(() => {
                console.log('All pages rendered');
            }).catch(error => {
                console.error('Error rendering pages:', error);
            });
        }

        // Render a single page
        function renderPage(pageNum, container) {
            return pdfDoc.getPage(pageNum).then(page => {
                const viewport = page.getViewport({ scale: 2 });
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.classList.add('border', 'border-gray-300', 'rounded', 'shadow'); // Tailwind classes for styling
                container.appendChild(canvas);

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport,
                };

                // Render the page
                return page.render(renderContext).promise.then(() => {
                    // After rendering the page, add the page number
                    context.fillStyle = "black"; // Set text color
                    context.font = "20px Arial"; // Set font size and family
                    context.textAlign = "right"; // Align text to the right
                    const pageNumText = `Page ${pageNum}`;
                    context.fillText(pageNumText, canvas.width - 10, canvas.height - 10); // Draw page number
                });
            });
        }
    });
</script>