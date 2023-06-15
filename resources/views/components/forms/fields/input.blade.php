@props([
    'name',
    'label',
    'value' => '',
    'type' => 'text',
    'id' => '',
])

<div>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input name="{{ $name }}" type="{{ $type }}" {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $id ?? $name }}" @if($value) value="{{ $value }}" @endif {{ $attributes }}>
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
