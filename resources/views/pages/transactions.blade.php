@extends('layouts.master')
@section('title', 'PRM | Inventory')
@section('nav-title', 'Inventory')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-logo-dark text-light">
        <span class="fw-semibold mt-2">
            <i class="bi bi-table me-2"></i>Transactions
        </span>
    </div>
    <div class="card-body p-4">
        <button class="btn btn-dark fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#generateSalesModal">
            <i class="bi bi-clipboard-data-fill me-2"></i>Generate report
        </button>
        <div class="table-responsive">
            <table id="transactions-table" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>ORDER DETAILS</th>
                        <th>GRAND TOTAL</th>
                        <th>CHANGE</th>
                        <th>METHOD</th>
                        <th>DATE</th>
                        <th><i class="bi bi-sliders"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->order_id }}</td>
                        <td>
                            @foreach ($transaction->order->orderDetails as $item)
                            <small>
                                {{ $item->quantity . "X " . $item->product->brand . " | " . $item->product->size . " | P
                                " . number_format($item->price, 2, '.', ',') . " | Total: P " .
                                number_format($item->total, 2, '.', ',')
                                }}
                            </small>
                            <br>
                            @endforeach

                        </td>
                        <td>{{ "P " . number_format($transaction->order->grand_total, 2, '.', ',') }}</td>
                        <td>{{ "P " . number_format($transaction->change, 2, '.', ',') }}</td>
                        <td>
                            {{ $transaction->payment_method }}
                            <br>
                            @if($transaction->payment_method === "Gcash")
                            {{ "Ref. #: " . $transaction->reference_number }}
                            @endif
                        </td>
                        <td>{{ date('F jS, Y h:i:s', strtotime($transaction->created_at)); }}</td>
                        <td>
                            <a href="{{ route('order-checkout', ['id' => $transaction->id]) }}"
                                class="btn btn-dark bg-logo-dark"><i class="bi bi-receipt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modals.generate-sales')
<script>
    $(document).ready(function() {
        $('#transactions-table').DataTable();
    });
</script>
@endsection