@if(Session::has('toasts'))
    @pushonce('head')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @endpushonce

    @pushonce('footer')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js" onload="onToastifyLoaded()"></script>
    @endpushonce

    <script>
        function onToastifyLoaded() {
            @foreach(session()->pull('toasts') as $toast)
                toast("{{ $toast['message'] }}", "{{ $toast['status'] }}");
            @endforeach
        }
    </script>
@endif
