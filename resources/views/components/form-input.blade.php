@props([
'label',
'type',
'name',
'id',
'value' => null,
'placeholder' => null,
])

<div class="form-group mb-3">
    <label class="fw-semibold" for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $id }}" value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder }}">
</div>