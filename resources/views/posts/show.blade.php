@extends('layouts.app')

@section('content')
    <article>
        <div>
            <h1>{{ $post->title }}</h1>

        </div>
        <div>
            @markdown($post->content)
        </div>
    </article>

    <x-siblings-pagination :$previous :$next/>

    <div class="bg-secondary p-1">
        <table class="table">
            <thead>
            <tr>
                <th>Author</th>
                <th>Timestamp</th>
                @isAdminOrOwner($post->user)
                <th>Actions</th>
                @endisAdminOrOwner
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <x-avatar class="avatar-md" :user="$post->user"></x-avatar>
                </td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                @isAdminOrOwner($post->user)
                <td>
                    <a href="{{ route('posts.edit', $post) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <a href="#"
                           onclick="this.closest('form').submit();return false;">Delete</a>
                    </form>
                </td>
                @endisAdminOrOwner
            </tr>
            </tbody>
        </table>
    </div>

@endsection
