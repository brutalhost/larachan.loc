@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <x-form action="{{ route('register.form_post') }}">
        <x-form.group key="name">
            <label for="name">Name:</label>
            <input class="form-input" type="text" name="name" id="name" value="{{ old('name') }}">
        </x-form.group>

        <x-form.group key="username">
            <label for="username">Username:</label>
            <input class="form-input" type="text" name="username" id="username" value="{{ old('username') }}">
        </x-form.group>

        <x-form.group key="email">
            <label for="email">Email:</label>
            <input class="form-input" type="email" name="email" id="email" value="{{ old('email') }}">
        </x-form.group>

        <x-form.group key="password">
            <label for="password">Password:</label>
            <input class="form-input" type="password" name="password" id="password" value="{{ old('password') }}">
        </x-form.group>

        <x-form.password-confirmation/>
    </x-form>
@endsection
