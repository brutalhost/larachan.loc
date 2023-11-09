@extends('layouts.app')

@php
    $isEditingPage = Route::currentRouteNamed('posts.edit');
@endphp

@section('title', $isEditingPage ? 'Edit ' . $post->title : 'Create Post')

@section('content')
    @include('assets.md-editor')

    <x-form action="{{ $isEditingPage ? route('posts.update', $post) : route('posts.store') }}">
        @isset($isEditingPage)
            @method('PUT')
        @endisset

        <x-form.group key="title">
            <label for="title">Title:</label>
            <input class="form-input" type="text" name="title" id="title"
                   value="{{ old('title', $post->title ?? '') }}">
        </x-form.group>

        <x-form.group key="content">
            <label for="content">Content:</label>
            <div class="md-editor">
                <textarea class="form-input" name="content"
                          id="content">{{ old('content', $post->content ?? '') }}
                </textarea>
            </div>
        </x-form.group>

        @if($isEditingPage)
            <x-form.timestamps :entity="$post"/>
        @endif
    </x-form>
@endsection
