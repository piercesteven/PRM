@extends('layouts.master')
@section('title', 'PRM | Stock in')
@section('nav-title', 'Stock in')
@section('content')
<div class="container-fluid row">
    <div class="col-12 col-sm-12 col-mb-10 col-lg-8 " style="max-height: 500px; overflow-y: auto;">
        <div class="card mx-auto">
            <div class="card-header p-3 bg-logo-dark" style="position: sticky; z-index: 100; top: 0;">
                <div class="col-6">
                    <div class="form-gorup">
                        <label for="search-tools" class="fw-bold text-white">SEARCH PRODUCT</label>
                        <input type="text" id="search-tools" class="form-control text-dark bg-white"
                            placeholder="Search...">
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Brand</th>
                            <th>Size</th>
                            <th>Type</th>
                            <th>Stocks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="clickable-row" data-href="{{ route('stock-in-product', ['id' => $product->id]) }}">
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->size }}</td>
                            <td>{{ $product->type }}</td>
                            <td>{{ $product->stocks }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-11 col-mb-8 col-lg-4 mb-3" id="customer-div" style="height: 100%; overflow-y: auto;">
        <div class="mx-auto">
            @if(empty($stock_in))
            <button class="btn btn-dark fw-bold form-control" data-bs-toggle="modal" data-bs-target="#batchCreateModal">
                <i class="bi bi-stack me-2"></i>Create new stock in batch
            </button>
            @else
            <div class="card">
                <div class="card-header p-3 bg-logo-dark text-white fw-semibold fs-6">
                    Batch # : {{ $stock_in->batch_number ? $stock_in->batch_number : "N/A" }}
                </div>
                <div class="card-body">
                    <span class="fw-bold">
                        Batch details
                    </span>
                    @forelse ($batch_products as $stock)
                    <div class="card p-2">
                        <div class="d-flex">
                            <div class="ms-2 align-items-center justify-content-between py-1" style="width: 60px;">
                                <h2 class="text-logo-dark fw-bold">
                                    {{ $stock->original_quantity }}X
                                </h2>
                            </div>
                            <div class="d-flex justify-content-between" style="width: 100%; ">
                                <div class="d-flex flex-column p-2">
                                    <span class="text-dark fw-bold">
                                        {{ $stock->product->brand }} | {{ $stock->product->size }}
                                    </span>
                                    <small style="font-size: 13px; margin-top: -5px;">
                                        <a href="{{ route('remove-product', ['id' => $stock->id]) }}"
                                            class="text-danger fw-bold me-2">Remove</a>
                                    </small>
                                </div>
                                <small class="fw-bold mt-2 d-flex flex-column">
                                    <small>Price: P {{ number_format($stock->price) }}</small>
                                    <small>SubTotal: P {{ number_format($stock->sub_total) }}</small>
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center my-3">
                        <span class="fw-bold">No data added yet.</span>
                    </div>
                    @endforelse
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <h6 class="fw-bold me-4">
                        Grand Total: P {{ number_format($grand_total) }}
                    </h6>
                </div>
                <div class="card-footer">
                    <a href="{{ route('stockin-product-batches') }}" class="btn btn-dark fw-bold form-control">
                        <i class="bi bi-truck me-2"></i>Stock In</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@include('modals.batch-create')
<script>
    $(document).ready(function() {
        $('.clickable-row').on('click', function() {
            const url = $(this).data('href'); // Get the URL from the data-href attribute
            if (url) {
                window.location.href = url; // Redirect to the URL
            }
        });
    });
</script>
@endsection