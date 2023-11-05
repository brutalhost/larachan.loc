<x-form.group key="password_confirmation">
    <label for="password_confirmation">Password confirmation:</label>
    <input class="form-input" type="password" name="password_confirmation" id="password_confirmation"
           value="{{ old('password_confirmation') }}">
</x-form.group>
