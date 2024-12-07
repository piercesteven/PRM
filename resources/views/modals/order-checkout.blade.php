<x-modal id="orderCheckoutModal" size="md" title="Checkout order">
    <div class="row mb-3">
        <div class="col-6">
            <input type="radio" class="btn-check" name="paymentMethod" id="btn-cash" autocomplete="off">
            <label class="btn btn-outline-primary form-control border-3 fw-bold" for="btn-cash">Cash</label><br>
        </div>
        <div class="col-6">
            <input type="radio" class="btn-check" name="paymentMethod" id="btn-gcash" autocomplete="off">
            <label class="btn btn-outline-primary form-control border-3 fw-bold" for="btn-gcash">Gcash</label><br>
        </div>
    </div>

    <div id="ifGcash" style="display: none;">
        <div class="input-group flex-nowrap">
            <span class="input-group-text fw-bold" id="addon-wrapping">Grand Total:</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="grand_total"
                aria-describedby="addon-wrapping" value="{{ 'P ' . number_format($grand_total, 2, '.', ',') }}"
                readonly>
        </div>
        <form action="{{ route('checkout-gcash') }}">
            <div class="form-group my-3">
                <label for="reference_number" class="fw-bold">Enter reference number</label>
                <input type="text" class="form-control" name="reference_number" id="reference_number">
            </div>
            <input type="hidden" name="amount" value="{{ $grand_total }}">
            <input type="hidden" name="method" value="Gcash">
            <hr>
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-dark fw-bold" type="submit">Checkout</button>
                <x-modal-cancel-button>Cancel</x-modal-cancel-button>
            </div>
        </form>
    </div>
    <div id="ifCash" style="display: none;">
        <div class="input-group flex-nowrap">
            <span class="input-group-text fw-bold" id="addon-wrapping">Grand Total:</span>
            <input type="text" class="form-control" placeholder="Grand Total" aria-label="grand_total"
                aria-describedby="addon-wrapping" value="{{ 'P ' . number_format($grand_total, 2, '.', ',') }}"
                id="grandTotal" readonly>
        </div>
        <form action="{{ route('checkout-cash') }}">
            <div class="row">
                <div class="col-8">
                    <div class="form-group my-3">
                        <label for="amount" class="fw-bold">Enter amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group my-3">
                        <label for="cha" class="fw-bold">Change</label>
                        <input type="text" class="form-control" name="change" id="change" readonly>
                    </div>
                </div>
                <input type="hidden" name="method" value="Cash">
            </div>
            <hr>
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-dark fw-bold" type="submit">Checkout</button>
                <x-modal-cancel-button>Cancel</x-modal-cancel-button>
            </div>
        </form>
    </div>
</x-modal>
<script>
    $(document).ready(function () {
        // Toggle visibility between Gcash and Cash options
        $('input[name="paymentMethod"]').on('change', function () {
            if ($('#btn-gcash').is(':checked')) {
                $('#ifGcash').show();
                $('#ifCash').hide();
            } else if ($('#btn-cash').is(':checked')) {
                $('#ifCash').show();
                $('#ifGcash').hide();
            }
        });

        // Calculate change dynamically
        $('#amount').on('input', function () {
            const grandTotal = parseFloat($('#grandTotal').val().replace('P ', '').replace(',', ''));
            const amount = parseFloat($(this).val());

            if (!isNaN(amount) && amount >= grandTotal) {
                $('#change').val((amount - grandTotal).toFixed(2));
            } else {
                $('#change').val(''); // Clear the change field if invalid input
            }
        });

        // Handle form submission without alert
        $('#cashForm').on('submit', function (e) {
            const grandTotal = parseFloat($('#grandTotal').val().replace('P ', '').replace(',', ''));
            const amount = parseFloat($('#amount').val());

            if (isNaN(amount) || amount < grandTotal) {
                e.preventDefault(); // Prevent form submission if invalid
            }
        });
    });
</script>