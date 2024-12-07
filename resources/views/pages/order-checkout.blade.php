@extends('layouts.master')
@section('title', 'PRM | Receipt')
@section('nav-title', 'Receipt')
@section('content')
<div class="container mt-4">
    <div class="card" style="max-width: 500px; margin: auto;">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center">
                <h4 class="fw-bold">PRM</h4>
                <span>Davao City, Diversion road El Rio</span>
                <span>Phone: (+63) 946 678 0829</span>
            </div>
            <hr>
            <div class="mb-3">
                <p class="d-flex justify-content-between"><strong>Date:</strong> <span>{{
                        $payment->created_at->format('F d, Y h:i A') }}</span></p>
                <p class="d-flex justify-content-between"><strong>Payment Method:</strong> {{ $payment->payment_method
                    }}</p>
                @if($payment->payment_method === 'Gcash')
                <p class="d-flex justify-content-between">
                    <strong>Reference Number:</strong> {{ $payment->reference_number }}
                </p>
                @endif
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="3">Order details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->quantity . "X " . $detail->product->brand }}
                                <br>
                                {{ $detail->product->size }}
                            </td>
                            <td>{{ "P " . number_format($detail->price, 2) }}</td>
                            <td>{{ "P " . number_format($detail->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="d-flex justify-content-between"><strong>Amount Paid:</strong> <span>{{
                        "P " . number_format($payment->amount, 2) }}</span></p>
                <p class="d-flex justify-content-between"><strong>Change:</strong> <span>
                        {{ "P " .number_format($payment->change, 2)
                        }}</span></p>
                <h6 class="text-secondary text-center mt-5">Thank you for visiting!</h6>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <button id="printReceipt" class="btn btn-primary">Download Receipt</button>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#printReceipt').on('click', function () {
            // Clone the card
            var cardContent = $('.card').clone();
            // Create a new window
            var printWindow = window.open('', '_blank', 'width=800, height=600');
            // Add basic HTML structure
            printWindow.document.write('<html><head><title>Receipt</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">');
            printWindow.document.write('</head><body>');
            // Add the cloned content
            printWindow.document.write(cardContent.html());
            printWindow.document.write('</body></html>');
            // Close document to ensure styles are loaded
            printWindow.document.close();
            // Trigger print
            printWindow.print();
        });
    });
</script>
@endsection