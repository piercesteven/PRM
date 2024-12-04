<x-modal id="productCreateModal" size="md" title="Add new product">
    <form action="{{ route('store-product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-6">
                <x-form-select label="Product Type" name="type" id="productType" :items="['Tire', 'Rim']" />
            </div>
            <div class="col-6">
                <x-form-input label="Brand" type="text" name="brand" id="productBrand" />
            </div>
            <div class="col-6">
                <x-form-input label="Material" type="text" name="material" id="productBrand" />
            </div>
            <div class="col-6">
                <x-form-input label="Size" type="text" name="size" id="productSize" />
            </div>
            <div class="col-12">
                <x-form-input label="Image" type="file" name="image_path" id="productImage" />
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>