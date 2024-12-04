@extends('layouts.master')
@section('title', 'PRM | Inventory')
@section('nav-title', 'Inventory')
@section('content')
<div class="card shadow-sm px-4 py-3">
    <div class="row">
        <div class="col-6">
            <h6 class="fw-bold my-3 text-logo-dark text-uppercase">
                Product Details
            </h6>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="card shadow-sm border-2 border-dark border-rounded">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="image" class="img-fluid">
                    </div>
                </div>
                <div class="col-6">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <x-form-input type="file" label="Update product image" name="image_path"
                                    id="productImages" />
                            </div>
                            <div class="col-12">
                                <button class="btn btn-sm btn-dark bg-logo-dark fw-bold float-end"><i
                                        class="bi bi-file-earmark-image me-2"></i>Update
                                    Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <form action="{{ route('update-product') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="col-6">
                        <x-form-select label="Product Type" name="type" id="productType" :items="['Tire', 'Rim']"
                            :selected="$product->type" />
                    </div>
                    <div class="col-6">
                        <x-form-input label="Brand" type="text" name="brand" id="productBrand"
                            :value="$product->brand" />
                    </div>
                    <div class="col-6">
                        <x-form-input label="Material" type="text" name="material" id="productBrand"
                            :value="$product->material" />
                    </div>
                    <div class="col-6">
                        <x-form-input label="Size" type="text" name="size" id="productSize" :value="$product->size" />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-sm btn-dark bg-logo-dark fw-bold float-end"><i
                                class="bi bi-pencil-square me-2"></i>Update
                            Details</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <br>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-bold">Current Price: {{ $current_price ? "P " . number_format($current_price->price) : "No
                    price
                    yet" }}</h6>
                <button class="btn btn-sm btn-dark bg-logo-dark fw-bold" data-bs-toggle="modal"
                    data-bs-target="#productPriceChange">
                    <i class="bi bi-tags-fill me-2"></i>Update price
                </button>
            </div>
            <hr>
            <div class="card table-responsive">
                <div class="card-header text-logo-dark fw-bold">
                    Product prices
                </div>
                <div class="card-body p-0" style="max-height: 130px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Price</th>
                                <th>Created</th>
                                <th>Effective date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prices as $price)
                            <tr>
                                <td>P {{ number_format($price->price, 0, '.', ',') }}</td>
                                <td>{{ $price->created_at->format('F j Y g:ia') }}</td>
                                <td>{{ \Carbon\Carbon::parse($price->effective_date)->format('F j, Y g:i a')
                                    }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No outdated price yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="col-12 card">
                <div class="card-header text-logo-dark fw-bold">
                    Tire stocks (Total stocks: {{ $product->stocks . " pcs" }})
                </div>
                <div class="card-body p-0">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <small class="fw-bold">
                                        Brand new stocks record ({{ $brandnew_quantity . " pcs" }})
                                    </small>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-0" style="max-height: 130px; overflow-y: auto;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Batch #</th>
                                                <th>DOT</th>
                                                <th>Bought Price</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->batchProducts as $item)
                                            @if($item->state == "Brand New")
                                            <tr>
                                                <td>{{ $item->batch->batch_number }}</td>
                                                <td>{{ $item->dot }}</td>
                                                <td>{{ "P " . number_format($item->price) }}</td>
                                                <td>{{ $item->quantity_left }} pcs</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <small class="fw-bold">
                                        Secondhand stocks record ({{ $secondhand_quantity . " pcs" }})
                                    </small>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body p-0" style="max-height: 130px; overflow-y: auto;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>DOT</th>
                                                <th>Qty</th>
                                                <th>Bought Price</th>
                                                <th>Sell Price</th>
                                                <th><i class="bi bi-tags-fill"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->batchProducts as $item)
                                            @if($item->state == "Secondhand")
                                            <tr>
                                                <td>{{ $item->dot }}</td>
                                                <td>{{ $item->quantity_left }} pcs</td>
                                                <td>{{ "P " . number_format($item->price) }}</td>
                                                <td>{{ "P " . number_format($item->sell_price) }}</td>
                                                <td>
                                                    <button class="btn btn-dark btn-sm fw-bold" data-bs-toggle="modal"
                                                        data-bs-target="#productSecondhandriceChange{{ $item->id }}"><i
                                                            class="bi bi-pencil-fill"></i></button>
                                                </td>
                                            </tr>
                                            @endif
                                            @include('modals.product-secondhand-price-change')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('inventory') }}" class="btn btn-sm btn-dark fw-bold float-end mt-3"><i
                    class="bi bi-backspace-fill me-2"></i>Go back
            </a>
        </div>
    </div>
</div>
{{-- Modals --}}
@include('modals.product-price-change')
@endsection