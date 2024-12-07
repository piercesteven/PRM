<x-modal id="orderCreateModal" size="md" title="Create new order">
    <div class="row">
        <div class="col-12">
            <span>Do you want to <strong>create</strong> a new order?</span>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('create-order') }}" class="btn btn-dark fw-bold">Submit</a>
        <x-modal-cancel-button>Cancel</x-modal-cancel-button>
    </div>
</x-modal>