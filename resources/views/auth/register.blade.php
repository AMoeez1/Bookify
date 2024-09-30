@extends('Layouts.auth')
@section('title', 'Register - Bookify Shelves')
@section('content')
    <?php
    $role = [['label' => 'Author', 'value' => 'au'], ['label' => 'User', 'value' => 'user']];
    ?>
    <form method="POST" action="{{ route('register') }}" class="bg-card p-8 rounded-lg bg-white shadow-lg w-full max-w-md">
        @csrf
        <h1 class="text-3xl text-center font-semibold font-mono mb-4 text-blue-400">Register</h1>
        <x-bladewind::input name="name" required="true" label="Full Name"
            error_message="You will need to enter your full name" />
        <x-bladewind::input name="email" required="true" label="Email"
            error_message="You will need to enter your valid email" />
        {{-- <x-bladewind::select name="role" placeholder="Your Role in this web"
                :data="$role" /> --}}
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
            option</label>
        <select id="countries" name="role"
            class="bg-gray-50 mb-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choose a Degree</option>
            <option value="Author">Author</option>
            <option value="User">User</option>
        </select>
        <x-bladewind::input type="password" viewable="true" prefix_is_icon="true" suffix="eye" name="password"
            required="true" label="Password" />
        <x-bladewind::button class="w-full" type="blue" outline='true' can_submit="true">
            Register
        </x-bladewind::button>
        <p class="mt-4" >Already have an account? <a class="underline" href="/login">Login</a></p>
        @error('Error')
        <x-bladewind::alert type="error">
            {{ $message }}
        </x-bladewind::alert>
        @enderror
    </form>

@endsection
