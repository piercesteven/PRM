@props([
'label',
'name',
'id',
'items' => [],
'selected' => null, // Default to null if not provided
])

<div class="form-group mb-3">
    <label class="fw-semibold" for="{{ $id }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $id }}" class="form-control">
        <option selected disabled></option>
        @foreach ($items as $item)
        <option value="{{ $item }}" {{ $item==$selected ? 'selected' : '' }}>
            {{ $item }}
        </option>
        @endforeach
    </select>
</div>