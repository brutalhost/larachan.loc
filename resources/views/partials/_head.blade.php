<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title'){{ config('app.separator') . config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/storage/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/storage/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/storage/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/storage/favicon/site.webmanifest') }}">

    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre.min.css">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre-exp.min.css">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre-icons.min.css">--}}

    @include('assets._libraries')
    @stack('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

