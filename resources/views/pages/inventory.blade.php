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

        <!-- Modal -->
        @include('modals.product-create')
        <div class="table-responsive">
            <table id="inventory-table" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="table-image-col">IMAGE</th>
                        <th>TYPE</th>
                        <th>STATE</th>
                        <th>BRAND</th>
                        <th>MATERIAL</th>
                        <th>SIZE</th>
                        <th>STOCKS</th>
                        <th><i class="bi bi-gear-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="table-image">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="">
                            </div>
                        </td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->state }}</td>
                        <td>{{ $product->brand }} </td>
                        <td>{{ $product->material }}</td>
                        <td>{{ $product->size }} </td>
                        <td>{{ $product->stocks }} </td>
                        <td>
                            <button class="btn btn-info btn-sm" title="Edit Product">
                                <i class="bi bi-pen-fill"></i>
                            </button>
                            <a href="{{ route('view-product', $product->id) }}" class="btn btn-primary btn-sm"
                                title="View Product">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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
    });
</script>
@endsection