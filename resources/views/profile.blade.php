@extends('layouts.pages')

@section('title', 'Profile - ' . Auth::user()->name)
<?php 
$user = Auth::user()
?>    


@section('content')
    {{$user->name}}
@endsection