<x-modal id="productSecondhandriceChange{{ $item->id }}" size="md" title="Update seconhand tire price">
    <form action="{{ route('update-secondhand-price') }}" method="POST">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $item->id }}">
        <x-form-input label="Enter new price" type="number" id="sell_price" name="sell_price" />
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" value="Submit" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>