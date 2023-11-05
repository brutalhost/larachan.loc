@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endpush

@push('footer')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js" onload="onMdeLoaded()"></script>
@endpush

<script>
    function onMdeLoaded() {
        var simplemde = new SimpleMDE({
            spellChecker: false,
            hideIcons: ["guide"],
            status: false,
        });
    }
</script>
