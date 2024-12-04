@extends('layouts.master')
@section('title', 'PRM | Inventory')
@section('nav-title', 'Inventory')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-logo-dark text-light">
        <span class="fw-semibold mt-2">
            <i class="bi bi-table me-2"></i>Products
        </span>
    </div>
    <div class="card-body p-4">
        <button class="btn btn-dark fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#productCreateModal">
            <i class="bi bi-patch-plus me-1"></i>Add new product
        </button>
        <div class="table-responsive">
            <table id="inventory-table" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th class="table-image-col">IMAGE</th>
                        <th>TYPE</th>
                        <th>BRAND</th>
                        <th>MATERIAL</th>
                        <th>SIZE</th>
                        {{-- <th>STATUS</th> --}}
                        <th>STOCKS</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td class="image-column">
                            <div class="table-image">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="">
                            </div>
                        </td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->brand }} </td>
                        <td>{{ $product->material }}</td>
                        <td>{{ $product->size }} </td>
                        {{-- <td>{{ $product->status ? "Active" : "Inactive" }}</td> --}}
                        <td>{{ $product->stocks }} </td>
                        <td>
                            <a href="{{ route('view-product', $product->id) }}"
                                class="btn btn-dark btn-sm fw-bold text-uppercase" title="View Product">
                                <i class="bi bi-eye-fill me-1"></i>View
                            </a>
                            {{-- <a href="{{ route('view-product', $product->id) }}"
                                class="btn btn-danger bg-logo-dark text-white btn-sm fw-bold text-uppercase"
                                title="Archive Product" data-bs-toggle="modal"
                                data-bs-target="#productArchiveModal{{ $product->id }}">
                                <i class="bi bi-archive-fill me-1"></i>Archive
                            </a> --}}
                        </td>
                    </tr>
                    {{-- Archive Modal --}}
                    {{-- @include('modals.product-archive') --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modals.product-image-view')
@include('modals.product-create')
<script>
    $(document).ready(function () {
        $('#inventory-table').DataTable({
            pageLength: 10, // Default number of rows
            order: [[1, 'asc']], // Sort by TYPE column
            columnDefs: [
                { orderable: false, targets: [0, 7] } // Disable sorting for IMAGE and ACTION
            ],
            language: {
                paginate: {
                    next: '»',
                    previous: '«'
                }
            }
        });
        $('#products').addClass('active');
        $('.image-column').click(function() {

        var imageSrc = $(this).find('img').attr('src');
        $('#enlargedImage').attr('src', imageSrc);
        $('#enlargedImageModal').modal('show');
        });
    });
</script>
@endsection