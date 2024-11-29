<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-{{ $centered ?? 'centered' }} modal-{{ $size }}">
        <div class="modal-content">
            <div class="modal-header bg-logo-dark text-light d-flex justify-content-between">
                <span class="modal-title fw-bold">{{ $title }}</span>
                <button type="button" class="btn btn-sm text-light" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>