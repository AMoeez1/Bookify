@extends('layouts.pages')
@section('title', 'Authors - Bookify')
@section('content')
    <div class="grid grid-cols-12 m-8">
        @foreach ($users as $user)
            <div class="col-span-4 m-4">
                <a href="{{url('user/' . $user->id)}}">
                    <x-bladewind::contact-card name="{{ $user->name }}" mobile="+233.123.456.789"
                        image="{{$user->image ? url('storage/' . $user->image) : '' }}" position="Senior Copywriter" email="{{ $user->email }}"
                        birthday="{{ \Carbon\Carbon::parse($user->date)->format('F Y') }}" />
                </a>
            </div>
        @endforeach
    </div>
@endsection
