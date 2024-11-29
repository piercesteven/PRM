@extends('layouts.master')
@section('title', 'PRM | Inventory')
@section('nav-title', 'Inventory')
@section('content')
<div class="card shadow-sm px-4 py-3">
    <div class="row">
        <div class="col-5 card">
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="image" class="img-fluid">
        </div>
        <div class="col-7">
            <h6 class="fw-bold my-3">
                Product details [Current Stocks ({{ $product->stocks }})]
            </h6>
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
                        <x-form-select label="Product State" name="state" id="productState"
                            :items="['Brand New', 'Secondhand']" :selected="$product->state" />
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
                        <button type="submit" class="btn btn-dark fw-bold float-end"><i
                                class="bi bi-pencil-square me-2"></i>Update
                            Details</button>
                    </div>
                </div>
            </form>
            <hr>
            <form action="">
                <div class="row">
                    <div class="col-12">
                        <x-form-input type="file" label="Update product image" name="image_path" id="productImages" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-dark fw-bold float-end"><i
                                class="bi bi-file-earmark-image me-2"></i>Update
                            Image</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection