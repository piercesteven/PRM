<x-modal id="productArchiveModal{{ $product->id }}" size="md" title="Archive product">
    <form action="{{ route('archive-product') }}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <span class="fs-6">
            Are you sure you want to <strong class="text-danger">remove</strong> this product?
        </span>
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" value="Submit" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>