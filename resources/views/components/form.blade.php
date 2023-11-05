<form {{ $attributes }} method="post">
    @csrf

    {{ $slot }}

    <x-form.submit>{{ $attributes->get('submit') ?? 'Submit' }}</x-form.submit>
</form>
