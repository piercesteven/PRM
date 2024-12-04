@extends('layouts.master')
@section('title', 'PRM | POS')
@section('nav-title', 'POS')
@section('content')
<div class="container-fluid row">
    <div class="col-12 col-sm-12 col-mb-10 col-lg-8 " style="max-height: 510px; overflow-y: auto;">
        <div class="card mx-auto">
            <div class="card-header p-3 bg-logo-dark" style="position: sticky; z-index: 100; top: 0;">
                <div class="col-6">
                    <div class="form-gorup">
                        <input type="text" id="search-tools" class="form-control text-dark bg-white"
                            placeholder="Search product">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-2 mt-1 px-4" id="product-container">
                    @foreach ($products as $product)
                    <div class="mb-3 product-card">
                        <div class="card border border-dark border-2">
                            <div class="card-header fw-bold bg-dark text-white name">
                                <span class="text-center">
                                    Brand: {{ $product->brand }}
                                </span>
                                <br>
                                <span class="text-center">
                                    Size: {{ $product->size }}
                                </span>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image"
                                    class='img-fluid m-auto border border-2 border-dark'
                                    style="height: 150px; width: 100%;">
                            </div>
                            <div class="card-footer">
                                <span class="fw-bold fs-6 text-dark" style="font-size: small;">
                                    Price: P {{ $product->currentPrice() }}
                                </span>
                                <a href="{{ route('add-order', ['id' => $product->id, 'state' => 'Brand New', 'stocks' => $product->brandnewStocks()]) }}"
                                    class="btn btn-dark bg-logo-dark fw-bold btn-sm form-control mt-2">
                                    Brand new: {{ $product->brandnewStocks() }} pcs
                                </a>
                                <hr>
                                <a href="{{ route('add-order', ['id' => $product->id, 'state' => 'Secondhand', 'stocks' => $product->secondhandStocks()]) }}"
                                    class="btn btn-dark fw-bold btn-sm form-control">
                                    Secondhand: {{ $product->secondhandStocks() }} pcs
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-11 col-mb-8 col-lg-4 mb-3" id="customer-div" style="height: 100%; overflow-y: auto;">
        <div class="mx-auto">
            @if(empty($order))
            <button class="btn btn-dark fw-bold form-control" data-bs-toggle="modal" data-bs-target="#orderCreateModal">
                <i class="bi bi-basket-fill me-2"></i>Create new order
            </button>
            @else
            <div class="card">
                <div class="card-header p-3 bg-logo-dark text-white fw-semibold fs-5">
                    Order # : 12
                </div>
                <div class="card-body">
                    <span class="fw-bold">
                        Order details
                    </span>
                    <div class="card p-2">
                        <div class="d-flex">
                            <div class="ms-2 align-items-center justify-content-between py-1" style="width: 60px;">
                                <h2 class="text-logo-dark fw-bold">
                                    2X
                                </h2>
                            </div>
                            <div class="d-flex justify-content-between" style="width: 100%; ">
                                <div class="d-flex flex-column p-2">
                                    <h6 class="text-dark fw-bold">
                                        Durun 165-65-R15
                                    </h6>
                                    <span style="font-size: 13px; margin-top: -5px;">
                                        <a class="text-danger fw-bold me-2">Remove</a>
                                    </span>
                                </div>
                                <h6 class="fw-bold mt-3">
                                    P 3,200
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <h5 class="fw-bold me-4">
                        Total: P 6,400
                    </h5>
                </div>
                <div class="card-footer">
                    <button class="btn btn-dark fw-bold form-control">
                        <i class="bi bi-cart-check-fill me-2"></i>Checkout</button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('modals.order-create')
<script>
    $(document).ready(function() {
        $('#search-tools').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            $('.product-card').each(function() {
                var productName = $(this).find('.name').text().toLowerCase();
                if (productName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection