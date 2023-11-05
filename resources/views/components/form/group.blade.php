@php
    $key = $attributes->get('key');
@endphp

<div {{ $attributes->merge([
    'class' => 'form-group ' .  ((!empty($key) && $errors->has($key)) ? 'has-error' : '')]) }}
>
    {{ $slot }}

    @if(!empty($key))
        <x-form.error-field :key="$key"/>
    @endif
</div>
