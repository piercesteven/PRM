<x-modal id="productPriceChange" size="md" title="Update product price">
    <form action="{{ route('change-price') }}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <x-form-input label="Enter new price" type="number" id="price" name="price" />
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" value="Submit" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>