@props([
    'name',
    'label',
])

<div>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-select" aria-label="{{ $label }}" id="{{ $name }}" name="{{ $name }}">
        {{ $slot }}
    </select>
    @error($name)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
