@extends('Layouts.pages')
@section('title', 'Book', $book->name)
@section('content')
    {{$book->name}}

    <a href="{{url('book/' . $book->slug . '/download')}}">Download</a>
@endsection