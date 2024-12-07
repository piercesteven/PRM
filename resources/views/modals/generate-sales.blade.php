<x-modal id="generateSalesModal" size="md" title="Generate sales report">
    <form action="{{ route('generate-sales') }}" method="POST">
        @csrf
        @method('POST')
        <div class="input-group flex-nowrap mb-3">
            <span class="input-group-text fw-bold" id="addon-wrapping">Start:</span>
            <input type="date" name="start" class="form-control" placeholder="Select start date"
                aria-describedby="addon-wrapping" required>
        </div>
        <div class="input-group flex-nowrap mb-3">
            <span class="input-group-text fw-bold" id="addon-wrapping">End:</span>
            <input type="date" name="end" class="form-control" placeholder="Select end date"
                aria-describedby="addon-wrapping" required>
        </div>
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" value="Submit" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>