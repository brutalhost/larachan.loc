@extends('layouts.app')

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
                    <td><img class="avatar img-fit-cover" src="{{ asset('avatars/' . $user->avatar) }}"
                             alt="{{ $user->name }} avatar"></td>
                    <td colspan="2">
                        <a href="{{ route('users.show', $user->username) }}"><b>{{ $user->username }}</b>
                            ({{ $user->name }})</a>
                    </td>
                    <td>{{ $user->posts->count() }}</td>
                    {{--                    <td><a href="{{ route('users.show', $user->username) }}">{{ $user->username }}</a></td>--}}
                </tr>
            @endforeach
        @endslot
    </x-table>
    <x-paginator :collection="$users"></x-paginator>
@endsection
