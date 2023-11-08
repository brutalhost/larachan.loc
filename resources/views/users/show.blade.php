@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column col-4 col-sm-12">
            <img class="img-responsive s-rounded"
                 src="{{ Image::profileAvatarSize()->get('/storage/avatars/' . $user->avatar) }}"
                 alt="{{ $user->name }} avatar">
        </div>
        <div class="column">
            <x-table>
                @slot('head')
                    <tr>
                        <th>Field</th>
                        <th>Data</th>
                    </tr>
                @endslot
                @slot('body')
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <td>Posts count</td>
                        <td>{{ $user->posts->count() }}</td>
                    </tr>
                    <tr>
                        <td>Verified email</td>
                        <td>
                            @if(is_null($user->email_verified_at))
                                @isOwner($user)
                                <form action="{{ route('verification.send') }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">Send verification link</button>
                                </form>
                                @else
                                Not verified
                                @endisOwner
                            @else
                                {{ $user->email_verified_at  }}
                            @endif
                        </td>
                    </tr>
                    @isAdminOrOwner($user)
                    <tr>
                        <td>Actions</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="#" onclick="this.closest('form').submit();return false;">Delete</a>
                            </form>
                        </td>
                    </tr>
                    @endisAdminOrOwner
                @endslot
            </x-table>
        </div>
    </div>

    <x-siblings-pagination :$previous :$next/>

    <h2>Posts</h2>
    <x-table>
        @slot('head')
            <tr>
                <th colspan="2">
                    Title
                </th>
                <th>
                    Timestamp
                </th>
            </tr>
        @endslot
        @slot('body')
            @if($posts->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">
                        Nothing found
                    </td>
                </tr>
            @else
                @foreach ($posts as $post)
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('posts.show', $post) }}"> {{ Str::limit($post->title, 30) }}</a>
                        </td>
                        <td>
                            {{ $post->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
            @endif
        @endslot
    </x-table>
@endsection
