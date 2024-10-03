@extends('layouts.pages')
@section('title', 'Book - ' . $book->name)
@section('content')
    <h1 class="text-2xl my-4 text-center">Book Details</h1>
    <x-bladewind::table>
    <x-slot name="header">
        <th>Book Id</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Author Id</th>
        <th>Featured Author</th>
        <th>Description</th>
        <th>Cover Page</th>
    </x-slot>
    <tr>
        <td>{{$book->id}}</td>
        <td>{{$book->name}}</td>
        <td>{{$book->author_name}}</td>
        <td>{{$book->author_id}}</td>
        <td>{{$book->feat_author ? $book->feat_author : 'No Featured'}}</td>
        <td>{{$book->description}}</td>
        <td><img src="{{asset('storage/'. $book->thumbnail)}}" class="w-40 h-28 object-cover" alt="{{$book->slug}}"></td>
    </tr>
    </x-bladewind::table>
        <canvas id="pdf-canvas" class="w-1/2"></canvas>
        
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<script>
const url = "{{ asset('storage/' . $book->file) }}";
const loadingTask = pdfjsLib.getDocument(url);
loadingTask.promise.then(pdf => {
    pdf.getPage(1).then(page => {
        const viewport = page.getViewport({ scale: 5 });
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

</script>