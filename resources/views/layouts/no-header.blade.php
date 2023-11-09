@include('partials._head')
<div class="bg-secondary mb-2 py-2">
    @include('partials.navbar')
</div>
<div class="container grid-md">
    @yield('content')
</div>
@include('partials._footer')

