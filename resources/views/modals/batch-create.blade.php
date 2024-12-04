<x-modal id="batchCreateModal" size="md" title="Create new batch">
    <form action="{{ route('new-batch') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-12">
                <x-form-input label="Batch number" type="text" name="batch_number" id="batch_number" />
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="secondhand" name="secondhand">
                    <label class="form-check-label fw-bold" for="secondhand">Secondhand</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end gap-2">
            <input type="submit" class="btn btn-dark fw-bold" />
            <x-modal-cancel-button>Cancel</x-modal-cancel-button>
        </div>
    </form>
</x-modal>

<script>
    $(document).ready(function () {
        $('#secondhand').change(function () {
            if ($(this).is(':checked')) {
                $('#batch_number').val('').prop('disabled', true); // Clear and disable
            } else {
                $('#batch_number').prop('disabled', false); // Enable
            }
        });
    });
</script>