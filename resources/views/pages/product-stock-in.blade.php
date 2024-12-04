@extends('layouts.master')
@section('title', 'PRM | Stock in product')
@section('nav-title', 'Stock in product')
@section('content')
<div class="container-fluid bg-container">
    <div class="row g-4 p-3">
        <div class="col-md-12">
            <!-- Image and Details in one card -->
            <div class="card shadow">
                <div class="row g-0 ">
                    <!-- Image on the right -->
                    <div class="col-md-6 p-5">
                        <div class="card shadow ">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image"
                                class="img-fluid">
                        </div>
                    </div>
                    <!-- Details on the left -->

                    <div class="col-md-6 p-5">
                        <div class="card shadow p-4">
                            <h2 class="fw-bold text-dark ">
                                {{ $product->brand . " | " . $product->size}}
                            </h2>
                            <hr>
                            <form action="{{ route('add-to-batch') }}" action="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <input type="hidden" value="{{ $stock_in->id }}" name="batch_id">
                                    <div class="col-4">
                                        <x-form-input type="text" label="Product DOT" name="dot" id="dot" />
                                    </div>
                                    <div class="col-8">
                                        @php
                                        if($stock_in->batch_number) {
                                        $value = "Brand New";
                                        } else {
                                        $value = "Secondhand";
                                        }
                                        @endphp
                                        <div class="form-group">
                                            <label for="state" class="fw-bold">State</label>
                                            <input type="text" class="form-control" value="{{ $value }}" name="state"
                                                id="state" readonly>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <x-form-input type="number" label="Quantity" name="quantity" id="quantity" />
                                    </div>
                                    <div class="col-8">
                                        <x-form-input type="number" label="Price" name="price" id="price" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        @if($stock_in->batch_number === NULL)
                                        <x-form-input type="number" label="Selling price" name="sell_price"
                                            id="sell_price" />
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="col-6">
                                        <a href="{{ route('stock_in') }}"
                                            class="btn btn-dark btn-sm fw-bold form-control">Go back</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-dark btn-sm bg-logo-dark fw-bold form-control"
                                            type="submit">Add
                                            stock</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection