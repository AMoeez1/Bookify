@extends('Layouts.auth')
@section('title', 'Register - Bookify Shelves')
@section('content')
    
    <form method="POST" action="{{ route('reset_password') }}" class="bg-card p-8 rounded-lg bg-white shadow-lg w-full max-w-md">
        @if (session('Res'))
        <div class="flex justify-center transition-opacity duration-500 opacity-100" id="alert">
            <x-bladewind::alert type="success" size='tiny' class=" w-80">
                {{ session('Res') }}
            </x-bladewind::alert>
        </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error )
            <x-bladewind::alert type="error" class="w-80">
                {{ $error }}
            </x-bladewind::alert>
            @endforeach
        @endif
        @csrf
        <p class="text-center mb-4 font-semibold text-blue-500">Enter your valid email address</p>
        <x-bladewind::input name="email" required="true" label="Email"
            error_message="You will need to enter your valid email" />
        <x-bladewind::button class="w-full" type="blue" outline='true' can_submit="true">
            Send Password Link
        </x-bladewind::button>
        <a class="" href="/login">Login Again</a>
        @error('Error')
        <x-bladewind::alert type="error">
            {{ $message }}
        </x-bladewind::alert>
        @enderror
    </form>

@endsection
