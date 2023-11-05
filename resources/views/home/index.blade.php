@extends('layouts.app')
@section('content')
    <div class="hero hero-sm bg-secondary">
        <div class="hero-body">
            <h1>{{ config('app.name') }}</h1>
            <p>Blog and ecommerce site for peoples</p>
        </div>
    </div>
    @php
//    phpinfo();
    @endphp
@endsection
