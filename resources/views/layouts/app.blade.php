@include('partials._head')
<div class="bg-secondary mb-2 py-2">
    @include('partials.navbar')
</div>
<div class="container grid-md">
    @if(View::hasSection('title'))
        <h1>@yield('title')</h1>
    @endif
    {{--    <h1>@yield('title')</h1>--}}
    @yield('content')
</div>
@include('partials._footer')

