<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

</head>

<body>
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column align-items-center">
            <h2 class="fw-bold">PRM | Sales Report</h2>
            <h6 class="fw-bold">From {{ $data['start'] }} to {{ $data['end'] }}</h6>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>ORDER DETAILS</th>
                    <th>GRAND TOTAL</th>
                    <th>CHANGE</th>
                    <th>METHOD</th>
                    <th>DATE</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center gap-2 mt-4">
        <a href="{{ route('transactions') }}" class="btn btn-dark fw-bold">Go Back</a>
        <button id="printReport" class="btn btn-dark bg-logo-dark fw-bold">Print Report</button>
    </div>
</body>
<script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#printReport').on('click', function () {
            // Create a printable section
            var printContent = $('.container-fluid').html();
            var originalContent = $('body').html();

            // Replace body content with the printable section
            $('body').html(printContent);

            // Trigger the print dialog
            window.print();

            // Restore original content after printing
            $('body').html(originalContent);
            location.reload(); // Reload to restore scripts and styles
        });
    });
</script>

</html>