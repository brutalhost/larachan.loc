<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . config('app.separator', ' - ') : '' }}{{ config('app.name', 'Laravel') }}</title>

    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre.min.css">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre-exp.min.css">--}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/@spectre-org/spectre-css/dist/spectre-icons.min.css">--}}

    @include('assets._libraries')
    @stack('head')

    <link rel="stylesheet" href="{{ mix('/resources/css/app.css') }}">
    <script src="{{ mix('/resources/js/app.js') }}"></script>
</head>
<body>

