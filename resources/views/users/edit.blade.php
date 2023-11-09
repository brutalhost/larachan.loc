@extends('layouts.app', ['title' => 'Edit ' . $user->name])

@section('title', 'Edit ' . $user->name)

@section('content')
    @isAdminOrOwner($user)
    <x-form action="{{ route('users.update', $user->username) }}" enctype="multipart/form-data">
        @method('PUT')

        <input type="hidden" name="id" value="{{ $user->id }}">

        <x-form.group key="name">
            <label for="name">Name:</label>
            <input class="form-input" type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        </x-form.group>

        <x-form.group key="username">
            <label for="username">Username:</label>
            <input class="form-input" type="text" name="username" id="username" value="{{ old('username', $user->username) }}">
        </x-form.group>

        <x-form.group key="email">
            <label for="email">Email:</label>
            <input class="form-input" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        </x-form.group>

        <x-form.group key="avatar">
            <label for="avatar">Avatar:</label>
            <input class="form-input" type="file" name="avatar" autocomplete="avatar" value="{{ old('avatar') }}">
        </x-form.group>

        <x-form.group key="password" label="new password">
            <label for="password">Password:</label>
            <input class="form-input" type="password" name="password" id="password">
        </x-form.group>

        <x-form.password-confirmation/>
    </x-form>
    @endisAdminOrOwner
@endsection
