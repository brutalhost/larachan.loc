@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <x-form action="{{ route('password.email') }}">
        <x-form.group key="email">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </x-form.group>
    </x-form>
@endsection
