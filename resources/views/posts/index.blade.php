@extends('layouts.no-header')

@section('title', 'Posts')

@section('content')
    <div class="columns">
        <div class="column">
            <div class="d-inline-flex">
                <h1>
                    Posts
                    @can('create', \App\Models\Post::class)
                        <x-add-button class="ml-2 mb-1" href="{{ route('posts.create') }}"/>
                    @endcan
                </h1>
            </div>
        </div>
        <div class="column text-right">
            <x-search :$searchKey class="mt-2"></x-search>
        </div>
    </div>

    @if($posts->isNotEmpty())
        <div class="columns">
            @foreach ($posts as $post)
                <div class="column col-6 col-md-12 pb-2">
                    <div class="card card__fullheight">
                        <div class="card-header">
                            <div class="card-title h5">{{ Str::limit($post->title, 30) }}</div>
                            <div class="card-subtitle text-gray"></div>
                            <x-avatar class="avatar-sm" :user="$post->user"/>
                        </div>
                        <div class="card-body">
                            {{ Str::limit($post->content, 100) }}
                            <span class="text-muted d-block">
                             {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary" href="{{ route('posts.show', $post) }}">Read
                                more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <x-paginator :collection="$posts"></x-paginator>
    @else
        <div class="empty">
            <div class="empty-icon">
                <i class="icon icon-search icon-2x"></i>
            </div>
            <p class="empty-title h5">We couldn't find posts matching your request</p>
            <a href="{{ route('posts.index') }}" class="empty-subtitle">Return to list of all posts.</a>
        </div>
    @endif
@endsection
