<x-modal id="secondhandOrder{{ $item->id }}" size="md" title="Add secondhand order">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="input-group">
                <div class="input-group-text fw-bold text-uppercase">State:</div>
                <input type="text" class="form-control" id="state" placeholder="Username" value="{{ $state }}" readonly>
            </div>
        </div>
        <div class="col-6 mb-3">
            <div class="input-group">
                <div class="input-group-text fw-bold text-uppercase">Stocks:</div>
                <input type="text" class="form-control" id="totalStocks" placeholder="Username"
                    value="{{ $item->quantity_left . ' pcs' }}" readonly>
            </div>
        </div>
        <div class="col-6 mb-3">
            <div class="input-group">
                <div class="input-group-text fw-bold text-uppercase">Price:</div>
                <input type="text" class="form-control" id="currentPrice" value="{{ " P " . $item->sell_price }}"
                    readonly>
            </div>
        </div>
    </div>
    <hr>
    <form action="{{ route('add-order-detail') }}" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
        <input type="hidden" name="state" id="state" value="{{ $state }}">
        <input type="hidden" name="price" id="price" value="{{ $item->sell_price }}">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-text fw-bold text-uppercase">Quantity:</div>
                    <button class="btn btn-dark" type="button" id="decrementBtn">
                        <i class="bi bi-dash-lg"></i>
                    </button>
                    <input type="text" class="form-control text-center" id="quantity" name="quantity" value="0"
                        readonly>
                    <button class="btn btn-dark" type="button" id="incrementBtn">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="input-group">
                    <div class="input-group-text fw-bold text-uppercase">Total: P</div>
                    <input type="text" class="form-control" id="subTotal" value="0" readonly>
                </div>
            </div>
            <input type="hidden" id="hiddenQuantity" name="quantity" value="0">
            <input type="hidden" id="hiddenSubTotal" name="total" value="0">
            <div class="col-12">
                <button type="submit" class="form-control fw-bold btn btn-sm btn-dark bg-logo-dark mb-2">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> ADD TO
                    BASKET</button>
            </div>
        </div>
    </form>
</x-modal>