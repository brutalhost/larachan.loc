@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <x-form action="{{ route('login.form_post') }}">
        <x-form.group key="email">
            <label for="email">Email:</label>
            <input class="form-input" type="email" name="email" id="email" value="{{ old('email') }}">
        </x-form.group>

        <x-form.group key="password">
            <label for="password">Password:</label>
            <input class="form-input" type="password" name="password" id="password" value="{{ old('password') }}">
        </x-form.group>

        <x-form.group>
            <label class="form-checkbox">
                <input type="checkbox" name="remember" id="remember" value="{{ old('remember') }}">
                <i class="form-icon"></i> Remember me
            </label>
        </x-form.group>
    </x-form>
    <a href="{{ route('password.request') }}">Reset password</a>
@endsection
