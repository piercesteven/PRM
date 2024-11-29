<div class="form-group mb-3">
    <label class="fw-semibold" for="{{ $id }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $id }}" value="{{ $value ?? '' }}">
</div>