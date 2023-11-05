@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <x-form action="{{ route('password.update') }}">
        <input type="hidden" name="token" id="token" value="{{ $token }}">

        <x-form.group key="email">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </x-form.group>

        <x-form.group key="password">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
        </x-form.group>

        <x-form.password-confirmation/>
    </x-form>
@endsection
