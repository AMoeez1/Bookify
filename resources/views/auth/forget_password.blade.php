@extends('Layouts.auth')
@section('title', 'Reset Password - Bookify' )
@section('content')
<form method="POST" action="{{ route('change_password', ['token' => $token]) }}" class="bg-card p-8 rounded-lg bg-white shadow-lg w-full max-w-md">
    @csrf
    <h1 class="text-3xl text-center font-semibold font-mono mb-4 text-blue-400">Register</h1>
    <x-bladewind::input name="email" required="true" label="Email"
        error_message="You will need to enter your valid email" />
    <x-bladewind::input type="password" viewable="true" prefix_is_icon="true" suffix="eye" name="password"
        required="true" label="Password" />
    <x-bladewind::input type="password" viewable="true" prefix_is_icon="true" suffix="eye" name="conf_password"
        required="true" label="Confirm Password" />
    <x-bladewind::button class="w-full" type="blue" outline='true' can_submit="true">
        Change Password
    </x-bladewind::button>
    @error('Error')
    <x-bladewind::alert type="error">
        {{ $message }}
    </x-bladewind::alert>
    @enderror
</form>
@endsection
