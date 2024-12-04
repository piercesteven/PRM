@extends('layouts.master')
@section('title', 'PRM | Add to order')
@section('nav-title', 'Add to order')
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
                            <div class="d-flex justify-content-between">
                                <h5 class="fw-bold text-dark ">
                                    {{ $product->brand . " | " . $product->size }}
                                </h5>
                                <a href="{{ route('pos') }}" class="btn btn-dark btn-sm fw-bold">GO BACK</a>
                            </div>
                            <hr>
                            @if($state == "Brand New")
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text fw-bold text-uppercase">State:</div>
                                        <input type="text" class="form-control" id="state" placeholder="Username"
                                            value="{{ $state }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text fw-bold text-uppercase">Stocks:</div>
                                        <input type="text" class="form-control" id="totalStocks" placeholder="Username"
                                            value="{{ $product->brandnewStocks() . ' pcs' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text fw-bold text-uppercase">Price:</div>
                                        <input type="text" class="form-control" id="currentPrice" placeholder="Username"
                                            value="{{ " P " . $product->currentPrice() }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" class="form-control" value="{{ $order->id }}">
                                <input type="hidden" class="form-control" value="{{ $product->id }}">
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text fw-bold text-uppercase">Quantity:</div>
                                        <button class="btn btn-dark" type="button" id="decrementBtn">
                                            <i class="bi bi-dash-lg"></i>
                                        </button>
                                        <input type="text" class="form-control text-center" id="quantity"
                                            name="quantity" value="0" readonly>
                                        <button class="btn btn-dark" type="button" id="incrementBtn">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-text fw-bold text-uppercase">Total: P</div>
                                        <input type="text" class="form-control" name="subtotal" id="subTotal"
                                            placeholder="Username" value="0" readonly>
                                    </div>
                                </div>
                                <input type="hidden" id="hiddenQuantity" name="quantity" value="0">
                                <input type="hidden" id="hiddenSubTotal" name="subtotal" value="0">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit"
                                            class="form-control fw-bold btn btn-sm btn-dark bg-logo-dark mb-2">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i> ADD TO
                                            BASKET</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('pos') }}" type="button"
                                            class="form-control fw-bold btn btn-dark btn-sm">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i> GO BACK</a>
                                    </div>
                                </div>

                            </form>
                            @elseif ($state == "Secondhand")
                            Secondhand
                            @else
                            <span class="text-center fw-bold fs-6 text-logo-dark">
                                Something went wrong.
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    // Function to calculate subtotal
        function calculateSubtotal() {
            var quantity = parseInt($('#quantity').val()); // Use .val() for input fields
            var price = parseFloat($('#currentPrice').val().replace("P ", "")); // Remove "P " and convert to number
            var subtotal = quantity * price;
            return subtotal.toFixed(2); // Limit to two decimal places
        }

        // Update hidden inputs for quantity and subtotal
        function updateHiddenValues() {
            var currentQuantity = parseInt($('#quantity').val());
            var currentSubtotal = calculateSubtotal();

            $('#hiddenQuantity').val(currentQuantity);
            $('#hiddenSubTotal').val(currentSubtotal);
        }

        // Get the totalStocks value
        var totalStocks = parseInt($('#totalStocks').val().replace(" pcs", "")); // Remove "pcs" and convert to number

        // Update quantity in the input when buttons are clicked
        $('#incrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').val());
            if (currentValue < totalStocks) { // Ensure quantity does not exceed totalStocks
                $('#quantity').val(currentValue + 1); // Update the input field
                updateHiddenValues(); // Update hidden inputs for quantity and subtotal
                $('#subTotal').val(calculateSubtotal()); // Update subtotal
            } else {
                alert('Quantity cannot exceed total stocks!'); // Optional alert for feedback
            }
        });

        $('#decrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').val());
            if (currentValue > 0) {
                $('#quantity').val(currentValue - 1); // Update the input field
                updateHiddenValues(); // Update hidden inputs for quantity and subtotal
                $('#subTotal').val(calculateSubtotal()); // Update subtotal
            }
        });

        // Initial calculation of subtotal
        $('#quantity').change(function() {
            updateHiddenValues(); // Update hidden inputs for quantity and subtotal
            $('#subTotal').val(calculateSubtotal());
        });
    });
</script>
@endsection