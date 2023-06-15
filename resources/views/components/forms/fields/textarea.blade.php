@props([
    'name',
    'label',
    'value' => '',
])

<div>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" class="form-control" id="{{ $name }}">
        @if($value) {{ $value }} @endif
    </textarea>
    @error($name)
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
