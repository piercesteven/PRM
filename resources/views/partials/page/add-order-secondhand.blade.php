<div class="table-responsive" style="max-height: 300px;">
    <table class="table table-bordered">
        <thead>
            <th>DOT</th>
            <th>Orig. qty</th>
            <th>Qty left</th>
            <th>Price</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($product->batchProducts->where('state', $state)->where('quantity_left', '>', 0) as $item)
            <tr>
                <td>{{ $item->dot }}</td>
                <td>{{ $item->original_quantity }}</td>
                <td>{{ $item->quantity_left }}</td>
                <td>{{ $item->sell_price }}</td>
                <td>
                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                        data-bs-target="#secondhandOrder{{ $item->id }}">Add</button>
                </td>
            </tr>
            @include('modals.order-secondhand')
            @endforeach
        </tbody>
    </table>
    @include('modals.order-secondhand')
</div>