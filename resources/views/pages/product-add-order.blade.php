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
                            <h2 class="fw-bold mb-4 text-dark ">
                                {{ $product->brand . " | " . $product->size}}
                            </h2>
                            <hr>
                            <form action="" method="POST">
                                <input type="hidden" name="order_id" value="">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="col-12 mb-3 text-dark">
                                    <label class="fw-bold">Price:</label>
                                    <span>
                                        P 3,200
                                    </span>
                                </div>
                                <div class="col-12 mb-3 text-dark">
                                    <label class="fw-bold">Stocks:</label>
                                    <span>
                                        {{ $product->stocks }}
                                    </span>
                                </div>
                                <div class="col-12 mb-3 text-dark">
                                    <label class="fw-bold">Quantity:</label>
                                    <button type="button" id="decrementBtn" class="btn btn-dark me-2"><i
                                            class="bi bi-dash-lg"></i></button>
                                    <span id="quantity" name="quantity" class="text-center text-lg">0</span>
                                    <button type="button" id="incrementBtn" class="btn btn-dark mx-2"><i
                                            class="bi bi-plus-lg"></i></button>
                                </div>
                                <div class="col-12 mb-3 text-dark">
                                    <label class="fw-bold">Total Price:</label>
                                    <span id="subTotal" name="subtotal">0</span>
                                </div>
                                <input type="hidden" id="hiddenQuantity" name="quantity" value="0">
                                <input type="hidden" id="hiddenSubTotal" name="subtotal" value="0">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-dark bg-logo-dark form-control fw-bold"
                                            style="border: 2px solid;">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i> ADD TO
                                            ORDER</button>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ route('pos') }}" type="button"
                                            class="form-control fw-bold btn bg-dark text-white mt-2">
                                            <i class="fa fa-chevron-left" aria-hidden="true"></i> GO BACK</a>
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

<script>
    $(document).ready(function() {
        $('#customers').addClass('active');
        // Function to calculate subtotal
        function calculateSubtotal() {
            var quantity = parseInt($('#quantity').text()); // Get the quantity value from the span
            var price = parseFloat(3000);
            var subtotal = quantity * price;
            return subtotal.toFixed(2); // Limit to two decimal places
        }

        // Update hidden inputs for quantity and subtotal
        function updateHiddenValues() {
            var currentQuantity = parseInt($('#quantity').text());
            var currentSubtotal = calculateSubtotal();

            $('#hiddenQuantity').val(currentQuantity);
            $('#hiddenSubTotal').val(currentSubtotal);
        }

        // Update quantity in the span when buttons are clicked
        $('#incrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').text());
            $('#quantity').text(currentValue + 1); // Update the quantity span
            updateHiddenValues(); // Update hidden inputs for quantity and subtotal
            $('#subTotal').text(calculateSubtotal());
        });

        $('#decrementBtn').click(function() {
            var currentValue = parseInt($('#quantity').text());
            if (currentValue > 0) {
                $('#quantity').text(currentValue - 1); // Update the quantity span
                updateHiddenValues(); // Update hidden inputs for quantity and subtotal
                $('#subTotal').text(calculateSubtotal());
            }
        });

        // Initial calculation of subtotal
        $('#quantity').change(function() {
            updateHiddenValues(); // Update hidden inputs for quantity and subtotal
            $('#subTotal').text(calculateSubtotal());
        });

        // Prevent form submission if quantity is zero
        $('form').submit(function(e) {
            var currentValue = parseInt($('#quantity').text());
            if (currentValue === 0) {
                e.preventDefault(); // Prevent form submission
                Toastify({
                    text: 'Invalid Quantity.',
                    duration: 3000,
                    gravity: 'bottom',
                    backgroundColor: '#ff0012',
                }).showToast();
            }
        });
    });
</script>
@endsection