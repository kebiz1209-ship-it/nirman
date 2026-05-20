<div class="row">

    <div class="col-lg-4 col-md-6 col-12 mb-3">

        <div class="form-group">

            <label>
                Payment Name <span class="text-danger">*</span>
            </label>

            <input type="text"
                   name="payment_name"
                   class="form-control @error('payment_name') is-invalid @enderror"
                   placeholder="Enter Payment Name"
                   value="{{ old('payment_name', isset($payment) ? $payment->payment_name : '') }}">

            @error('payment_name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    <div class="col-lg-4 col-md-6 col-12 mb-3">

        <div class="form-group">

            <label>
                Status <span class="text-danger">*</span>
            </label>

            <select name="status"
                    class="form-control select2">

                <option value="1"
                    {{ old('status', isset($payment) ? $payment->status : 1) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('status', isset($payment) ? $payment->status : 1) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

        </div>

    </div>

</div>


<div class="row mt-3">

    <div class="col-sm-12 d-flex gap-2">

        <button type="submit"
                class="btn bg-blue-btn">

            <iconify-icon icon="solar:check-circle-broken"></iconify-icon>

            {{ isset($payment) ? 'Update' : 'Submit' }}

        </button>

        <a href="{{ route('payments.index') }}"
           class="btn bg-second-btn">

            <iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon>

            Back

        </a>

    </div>

</div>