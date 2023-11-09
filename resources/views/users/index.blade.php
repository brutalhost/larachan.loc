@extends('layouts.no-header')

@section('title', 'Users')

@section('content')
    <div class="columns">
        <div class="column">
            <div class="d-inline-flex">
                <h1>
                    Users
                </h1>
            </div>
        </div>
        <div class="column text-right">
            <x-search :$searchKey class="mt-2"></x-search>
        </div>
    </div>

    @if($users->isNotEmpty())
        <x-table nothingFoundColspan="4">
            @slot('head')
                <tr>
                    <th></th>
                    <th colspan="2">
                        Name
                    </th>
                    <th>
                        Posts count
                    </th>
                </tr>
            @endslot
            @slot('body')
                @foreach($users as $user)
                    <tr class="tr__va-middle">
                        <td><img class="avatar img-fit-cover"
                                 src="{{ Image::smallAvatarSize()->get('/storage/avatars/' . $user->avatar) }}"
                                 alt="{{ $user->name }} avatar"></td>
                        <td colspan="2">
                            <a href="{{ route('users.show', $user->username) }}"><b>{{ $user->username }}</b>
                                ({{ $user->name }})</a>
                        </td>
                        <td>{{ $user->posts->count() }}</td>
                    </tr>
                @endforeach
            @endslot
        </x-table>
        <x-paginator :collection="$users"></x-paginator>
    @else
        <div class="empty">
            <div class="empty-icon">
                <i class="icon icon-search icon-2x"></i>
            </div>
            <p class="empty-title h5">We couldn't find users matching your request</p>
            <a href="{{ route('users.index') }}" class="empty-subtitle">Return to list of all users.</a>
        </div>
    @endif
@endsection
