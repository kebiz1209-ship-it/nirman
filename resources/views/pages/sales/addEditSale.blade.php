@extends('layouts.app')

@section('script_top')
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    ?>
@endsection

@section('content')

<style>
input[type=number] {
    -webkit-appearance: none;
    margin: 0;
}

#currency_select_popup {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    background-image: url("../images/arrow-down.png");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;

    padding-right: 35px;
    /* space for arrow */
}

span#modal_currency_symbol {
    position: absolute;
    top: -3px;
    right: 15px;
    padding: 0;
    border: none;
    background-color: transparent;
    line-height: 1;
    font-size: 14px;
    font-weight: 700;
}


.modal {
    z-index: 1055 !important;
}

.modal-backdrop {
    z-index: 1050 !important;
}
</style>

<section class="main-content-wrapper">
    <section class="content-header d-flex justify-content-between align-items-center">
        <h3 class="top-left-header m-0">
            {{ isset($title) && $title ? $title : '' }}
        </h3>

        <button type="button" class="btn" id="openCurrencyModal" style="background-color:#A78BFA; color:#fff;">
            Change Currency
        </button>
    </section>

    @include('utilities.messages')

    <div class="box-wrapper">
        <!-- general form elements -->
        <div class="table-box">
            <!-- form start -->
            <!-- {!! Form::model(isset($obj) && $obj ? $obj : '', [
            'id' => 'sale_form',
            'method' => isset($obj) && $obj ? 'PATCH' : 'POST',
            'enctype' => 'multipart/form-data',
            'route' => ['sales.update', isset($obj->id) && $obj->id ? $obj->id : ''],
            ]) !!} -->

            {!! Form::model(isset($obj) ? $obj : null, [
            'id' => 'sale_form',
            'method' => isset($obj) ? 'PATCH' : 'POST',
            'enctype' => 'multipart/form-data',
            'route' => isset($obj)
            ? ['sales.update', $obj->id]
            : ['sales.store'],
            ]) !!}

            @csrf

            <div>
                <div class="row">
                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label>@lang('index.reference_no') <span class="required_star">*</span></label>
                            {!! Form::text('reference_no', isset($obj->reference_no) && $obj->reference_no ?
                            $obj->reference_no : $ref_no, [
                            'class' => 'check_required form-control',
                            'id' => 'code',
                            'onfocus' => 'select()',
                            'placeholder' => 'Reference No',
                            ]) !!}
                            <div class="text-danger d-none"></div>
                            @if ($errors->has('reference_no'))
                            <div class="error_alert text-danger">
                                {{ $errors->first('reference_no') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label>@lang('index.customers') <span class="required_star">*</span></label>
                            <div class="d-flex align-items-center">
                                <div class="w-100">
                                    <select class="form-control select2" id="customer_id" name="customer_id">
                                        <option value="">@lang('index.select_customer')</option>
                                        @foreach ($customers as $value)
                                        <?php
                                                $current_due = getCustomerDue($value->id);
                                                ?>
                                        <option data-credit_limit="{{ $value->credit_limit }}"
                                            data-current_due="{{ $current_due }}"
                                            {{ isset($obj->customer_id) && $obj->customer_id == $value->id ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div>
                                    <button type="button"
                                        class="btn btn-md pull-right fit-content bg-second-btn plus_add_btn ms-2 view_modal_button"
                                        data-bs-toggle="modal" data-bs-target="#customerModal">
                                        <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                            <div class="text-danger customerErr d-none"></div>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label>@lang('index.date') <span class="required_star">*</span></label>
                            {!! Form::text('date', isset($obj->sale_date) && $obj->sale_date ? $obj->sale_date :
                            old('date'), [
                            'class' => 'form-control customDatepicker check_required',
                            'readonly' => '',
                            'placeholder' => 'Date',
                            'id' => 'date',
                            ]) !!}
                            <div class="text-danger d-none"></div>
                            @if ($errors->has('date'))
                            <div class="error_alert text-danger">
                                {{ $errors->first('date') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label>@lang('index.status') <span class="required_star">*</span></label>
                            <select class="form-control select2 check_required" id="status" name="status">
                                <option value="Draft"
                                    {{ isset($obj->status) && $obj->status == 'Draft' ? ' selected' : '' }}>Draft
                                </option>
                                <option value="Final"
                                    {{ isset($obj->status) && $obj->status == 'Final' ? ' selected' : '' }}>Final
                                </option>
                            </select>
                            <div class="text-danger d-none"></div>
                            @if ($errors->has('status'))
                            <div class="error_alert text-danger">
                                {{ $errors->first('status') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 mb-2 col-md-4">
                        <div class="form-group">
                            <label>@lang('index.finished_product') <span class="required_star">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" name="product_id"
                                id="product_id">
                                <option value="">@lang('index.select')</option>
                                @foreach ($finishProducts as $fp)
                                @php
                                $current_total_stock = $fp->current_total_stock == null ? 0 : $fp->current_total_stock;
                                @endphp
                                <option
                                    value="{{ $fp->id . '|' . $fp->name . ' (' . $fp->code . ')|' . $fp->name . '|' . productSalePrice($fp->id) . '|' . getPurchaseSaleUnitById($fp->unit) . '|' . $setting->currency . '|' . $fp->stock_method . '|' . $current_total_stock }}">
                                    {{ $fp->name . '(' . $fp->code . ')' }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="purchase_cart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="w-5 text-start">@lang('index.sn')</th>
                                        <th class="w-25">@lang('index.finished_product')(@lang('index.code'))</th>
                                        <th class="w-15">@lang('index.sale_price')<span class="required_star">*</span>
                                        </th>
                                        <th class="w-10">@lang('index.quantity')<span class="required_star">*</span>
                                        </th>
                                        <th class="w-15">@lang('index.total') </th>
                                        <th class="w-15">INR Total</th>
                                        <th class="w-5 ir_txt_center">@lang('index.actions')</th>
                                    </tr>
                                </thead>
                                <tbody class="add_tr">
                                    @if (isset($sale_details) && $sale_details)
                                    @foreach ($sale_details as $key => $value)
                                    <?php
                                                $productInfo = getFinishedProductInfo($value->product_id);
                                                $manufactureInfo = $value->manufacture_id !=null ? getManufactureInfo($value->manufacture_id) : null;
                                                ?>
                                    <tr class="rowCount" data-id="{{ $value->product_id }}">
                                        <td class="width_1_p text-start">
                                            <p class="set_sn"></p>
                                        </td>
                                        <td><input type="hidden" value="{{ $value->product_id }}"
                                                name="selected_product_id[]">
                                            <span>{{ $productInfo->name }}({{ $productInfo->code }})</span>
                                            @if ($manufactureInfo && $manufactureInfo->expiry_days !== null &&
                                            $manufactureInfo->complete_date !== null && $manufactureInfo->expiry_days
                                            !== 0)
                                            <br><small>Expiry Date:
                                                {{ getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days)) }}</small>
                                            @endif
                                            @if ($manufactureInfo && $manufactureInfo->batch_no !== null &&
                                            $manufactureInfo->batch_no !== '')
                                            <br><small>Batch Number: {{ $manufactureInfo->batch_no }}</small>
                                            @endif
                                        </td>

                                        <td>
                                            <input type="hidden" value="{{ $value->manufacture_id }}" name="rm_id[]">
                                            <input type="hidden" value="{{ $value->manufacture_id }}"
                                                name="manufacture_id[]">
                                            <div class="input-group">
                                                <input type="number" name="unit_price[]" onfocus="this.select();"
                                                    class="check_required form-control integerchk input_aligning unit_price_c cal_row"
                                                    placeholder="Unit Price" value="{{ $value->unit_price }}"
                                                    id="unit_price_1">
                                                <span class="input-group-text currency_symbol_display">
                                                    {{ $setting->currency }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group">
                                                <input type="number" data-countid="1" id="qty_1"
                                                    name="quantity_amount[]" onfocus="this.select();"
                                                    class="check_required form-control integerchk input_aligning qty_c cal_row"
                                                    value="{{ $value->product_quantity }}" placeholder="Qty/Amount">
                                                <span
                                                    class="input-group-text">{{ getRMUnitById($productInfo->unit) }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group">
                                                <input type="number" id="total_1" name="total[]"
                                                    class="form-control input_aligning total_c"
                                                    value="{{ $value->total_amount }}" placeholder="Total" readonly="">
                                                <span
                                                    class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                                            </div>
                                        </td>

                                        <td class="inr_col">
                                            <div class="input-group">
                                                <input type="number" class="form-control input_aligning total_inr_c"
                                                    id="total_inr_1" placeholder="INR Total" readonly="">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                        </td>

                                        <td class="ir_txt_center"><a class="btn btn-xs del_row dlt_button">
                                                <iconify-icon icon="solar:trash-bin-minimalistic-broken"></iconify-icon>
                                            </a></td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    <input type="hidden" id="currency_id_direct" name="currency_id_direct" value="">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="quotation_page" value="0" />
                <div class="row mt-4">
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>@lang('index.note')</label>
                            {!! Form::textarea('note', null, [
                            'class' => 'form-control',
                            'id' => 'note',
                            'placeholder' => 'Note',
                            'rows' => '3',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-3">
                        <div class="row w-86 mb-2">
                            <label class="custom_label">@lang('index.subtotal')</label>
                            <div class="input-group">
                                {!! Form::text('subtotal', isset($obj->subtotal) && $obj->subtotal ? $obj->subtotal :
                                null, [
                                'class' => 'form-control',
                                'readonly' => '',
                                'id' => 'subtotal',
                                'placeholder' => 'Sub Total',
                                ]) !!}
                                <span class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                            </div>
                            <div class="input-group mt-1" id="subtotal_inr_wrap">
                                <input type="text" class="form-control" id="subtotal_inr" readonly
                                    placeholder="INR Subtotal">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>
                        <div class="row w-86 mb-2">
                            <label class="custom_label">@lang('index.other')</label>
                            <div class="input-group">
                                {!! Form::text('other', null, [
                                'class' => 'form-control integerchk cal_row',
                                'id' => 'other',
                                'placeholder' => 'Other',
                                ]) !!}
                                <span class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                            </div>
                            <div class="input-group mt-1" id="other_inr_wrap">
                                <input type="text" class="form-control" id="other_inr" readonly placeholder="INR Other">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>
                        <div class="row w-86 mb-2">
                            <div class="form-group">
                                <label class="custom_label">@lang('index.discount')</label>
                                {!! Form::text('discount', null, [
                                'class' => 'form-control discount cal_row',
                                'data-special_ignore' => 'ignore',
                                'id' => 'discount',
                                'placeholder' => 'Discount',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row w-86 mb-2">
                            <label class="custom_label">@lang('index.g_total')</label>
                            <div class="input-group">
                                {!! Form::text('grand_total', isset($obj->grand_total) && $obj->grand_total ?
                                $obj->grand_total : null, [
                                'class' => 'form-control',
                                'readonly' => '',
                                'id' => 'grand_total',
                                'placeholder' => 'G.Total',
                                ]) !!}
                                <span class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                            </div>
                            <div class="input-group mt-1" id="grand_total_inr_wrap">
                                <input type="text" class="form-control" id="grand_total_inr" readonly
                                    placeholder="INR Grand Total">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>

                        <div class="row w-86 mb-2">
                            <label class="custom_label">@lang('index.paid') <span class="required_star">*</span></label>
                            <div class="input-group">
                                {!! Form::text('paid', isset($obj->paid) && $obj->paid ? $obj->paid : null, [
                                'class' => 'form-control check_required integerchk cal_row',
                                'placeholder' => 'Paid',
                                'onfocus' => 'select()',
                                'id' => 'paid',
                                ]) !!}</td>
                                <span class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                            </div>
                            <div class="input-group mt-1" id="paid_inr_wrap">
                                <input type="text" class="form-control" id="paid_inr" readonly placeholder="INR Paid">
                                <span class="input-group-text">₹</span>
                            </div>
                            <div class="text-danger paidErr d-none"></div>
                        </div>
                        <div class="row w-86 mb-2">
                            <div class="form-group">
                                <label class="custom_label">@lang('index.account') <span
                                        class="required_star">*</span></label>
                                <div class="d-flex align-items-center">
                                    <div class="w-100">
                                        <select class="form-control select2 check_required" id="accounts"
                                            name="account">
                                            <option value="">Select</option>
                                            @foreach ($accounts as $value)
                                            <option
                                                {{ isset($obj->account_id) && $obj->account_id == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger d-none"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 ms-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="change_currency"
                                    name="change_currency" value="1"
                                    {{ isset($obj->converted_currency_id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="change_currency">
                                    @lang('index.change_currency')
                                </label>
                            </div>
                        </div>
                        <div class="{{ isset($obj->converted_currency_id) ? '' : 'd-none' }}" id="currency_section">
                            <div class="row mb-1">
                                <label class="custom_label">@lang('index.currency') </label>
                                <div class="d-flex align-items-center">
                                    <div class="w-100">
                                        <select tabindex="2"
                                            class="form-control @error('currency') is-invalid @enderror select2"
                                            id="currency" name="currency">
                                            <option value="">@lang('index.select')</option>
                                            @foreach (allCurrency() as $value)
                                            <option
                                                {{ (isset($obj->converted_currency_id) && $obj->converted_currency_id == $value->id) || old('currency') == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}|{{ $value->conversion_rate }}|{{ $value->symbol }}">
                                                {{ $value->symbol }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger d-none"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="currency_id" id="currency_id"
                                value="{{ isset($obj->converted_currency_id) ? $obj->converted_currency_id : old('converted_currency_id') }}" />
                            <div class="row mb-1">
                                <label class="custom_label">@lang('index.converted_amount')</label>
                                <div class="input-group">
                                    <input type="text" name="converted_amount" id="converted_amount"
                                        class="form-control @error('converted_amount') is-invalid @enderror integerchk converted_amount check"
                                        readonly placeholder="Converted Amount"
                                        value="{{ isset($obj->converted_amount) ? $obj->converted_amount : old('converted_amount') }}">
                                    <span
                                        class="input-group-text converted_amount_currency">{{ $setting->currency }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row w-86 mb-2">
                            <label class="custom_label">@lang('index.due')</label>
                            <div class="input-group">
                                {!! Form::text('due', isset($obj->due) && $obj->due ? $obj->due : null, [
                                'class' => 'form-control integerchk customer_current_due check',
                                'readonly' => '',
                                'placeholder' => 'Due',
                                'id' => 'due',
                                ]) !!}</td>
                                <span class="input-group-text currency_symbol_display">{{ $setting->currency }}</span>
                            </div>
                            <div class="input-group mt-1" id="due_inr_wrap">
                                <input type="text" class="form-control" id="due_inr" readonly placeholder="INR Due">
                                <span class="input-group-text">₹</span>
                            </div>
                        </div>
                    </div>

                </div>
                <input class="form-control customer_credit_limit" type="hidden"
                    value="{{ isset($obj->customer_id) ? getCustomerCreditLimit($obj->customer_id) : '' }}" />
                <input class="form-control customer_previous_due" type="hidden"
                    value="{{ isset($obj->customer_id) ? getCustomerDue($obj->customer_id) : '' }}" />


                <!-- ✅ ADD HERE -->


             <input type="hidden" id="is_edit_page"             value="{{ isset($obj) ? 1 : 0 }}">
<input type="hidden" id="selected_currency_id"     value="{{ isset($obj->currency_id) ? $obj->currency_id : '' }}">
<input type="hidden" id="selected_conversion_rate" value="{{ isset($obj) ? $conversionRate : 1 }}">
<input type="hidden" id="selected_currency_symbol" value="{{ isset($obj) ? $currencySymbol : '₹' }}">

                <input type="hidden" name="subtotal_converted" id="subtotal_converted"
                    value="{{ $obj->subtotal_converted ?? '' }}">
                <input type="hidden" name="other_converted" id="other_converted"
                    value="{{ $obj->other_converted ?? '' }}">
                <input type="hidden" name="grand_total_converted" id="grand_total_converted"
                    value="{{ $obj->grand_total_converted ?? '' }}">
                <input type="hidden" name="paid_converted" id="paid_converted" value="{{ $obj->paid_converted ?? '' }}">
                <input type="hidden" name="due_converted" id="due_converted" value="{{ $obj->due_converted ?? '' }}">
                <input type="hidden" name="conversion_rate" id="conversion_rate"
                    value="{{ $obj->conversion_rate ?? 1 }}">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="row mt-2">
            <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                <button type="submit" name="submit" value="submit" class="btn bg-blue-btn">
                    <iconify-icon icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')
                </button>
                <a class="btn bg-second-btn" href="{{ route('sales.index') }}">
                    <iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')
                </a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
    </div>
</section>


<div class="modal fade" id="customerModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    @lang('index.add_customer')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group">
                                <label class="control-label">@lang('index.name')<span class="ir_color_red">
                                        *</span></label>
                                <div>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        value="">
                                    <div class="customer_err_msg_contnr">
                                        <p class="customer_err_msg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group">
                                <label class="control-label">@lang('index.phone') <span
                                        class="required_star">*</span></label>
                                <div>
                                    <input type="text" class="form-control integerchk" id="phone" name="phone"
                                        placeholder="Phone" value="">
                                    <div class="customer_phone_err_msg_contnr err_cust">
                                        <p class="customer_phone_err_msg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <div class="form-group">
                                <label class="control-label">@lang('index.email') <span
                                        class="required_star">*</span></label>
                                <div>
                                    <input type="text" class="form-control" id="emailAddress" name="emailAddress"
                                        placeholder="Email" value="">
                                    <div class="customer_email_err_msg_contnr err_cust">
                                        <p class="customer_email_err_msg"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group">
                                <label class="control-label">@lang('index.address')</label>
                                <div>
                                    <textarea class="form-control" rows="3" name="supAddress"
                                        placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-2">
                            <div class="form-group">
                                <label class="control-label">@lang('index.note')</label>
                                <div>
                                    <textarea class="form-control" rows="4" name="note"
                                        placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-blue-btn" value="submit" id="addCustomer">
                    <iconify-icon icon="solar:check-circle-broken"></iconify-icon> @lang('index.submit')
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cartPreviewModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    @lang('index.select_finish_product')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i data-feather="x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">@lang('index.name'): </label>
                        <div class="col-sm-12">
                            <p id="item_name_modal"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="col-sm-12">@lang('index.current_stock'): <span id="item_stock_modal"></span></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">@lang('index.sale_price') <span
                                        class="required_star">*</span></label>

                                <div class="input-group">
                                    <input type="text" autocomplete="off"
                                        class="form-control integerchk1 unit_price_modal" onfocus="select();"
                                        name="unit_price_modal" id="" placeholder="Unit Price" value="">

                                    <span class="input-group-text" id="modal_currency_symbol">₹</span>
                                </div>
                                <input type="hidden" name="item_id_modal" id="item_id_modal" value="">
                                <input type="hidden" name="item_currency_modal" id="item_currency_modal" value="">
                                <input type="hidden" name="item_unit_modal" id="item_unit_modal" value="">
                                <input type="hidden" name="item_st_method" id="item_st_method" value="">
                                <input type="hidden" name="item_params" id="item_params" value="">
 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="custom_label">@lang('index.quantity') <span
                                    class="required_star">*</span></label>
                            <div class="input-group">
                                <input type="number" autocomplete="off" min="1" class="form-control integerchk1"
                                    onfocus="select();" name="qty_modal" id="qty_modal" placeholder="Quantity"
                                    value="1">
                                <span class="input-group-text modal_unit_name"></span>
                            </div>
                        </div>
                        <div class="col-md-12 d-none" id="batch_sec">
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th class="w-30">@lang('index.batch_no')</th>
                                        <th class="w-30">@lang('index.current_stock')</th>
                                        <th class="w-40">@lang('index.sale_qty')</th>
                                    </tr>
                                </thead>
                                <tbody id="batch_table_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ir_d_block">
                <button type="button" class="btn bg-blue-btn" id="addToCart">
                    <iconify-icon icon="solar:add-circle-broken"></iconify-icon>@lang('index.add_to_cart')
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Currency Modal -->
<div class="modal fade" id="currencyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:12px;">

            <div class="modal-header">
                <h5 class="modal-title">Select Currency</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Select Currency</label>
                    <div class="input-group">
                        <select id="currency_select_popup" class="form-control">
                            @foreach(allCurrency() as $currency)
                            <option value="{{ $currency->id }}|{{ $currency->conversion_rate }}|{{ $currency->symbol }}"
                                {{ $currency->symbol == '₹' ? 'selected' : '' }}>
                                {{ $currency->currency_name }} ({{ $currency->symbol }})
                            </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="mb-3 d-none" id="conversion_rate_box">
                    <label>Conversion Rate</label>
                    <input type="number" step="0.01" id="conversion_rate_input" class="form-control"
                        placeholder="Enter rate">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn bg-blue-btn" id="saveCurrency">Continue</button>
            </div>

        </div>
    </div>
</div>


@endsection

@section('script')
<?php
    $baseURL = getBaseURL();
    ?>
<script type="text/javascript" src="{!! $baseURL . 'frequent_changing/js/addSales.js' !!}"></script>
<script type="text/javascript" src="{!! $baseURL . 'frequent_changing/js/customer.js' !!}"></script>


<script>
let currencyModal;

document.addEventListener("DOMContentLoaded", function () {

    // ========================= 
    // INIT MODAL
    // =========================
    let currencyModalEl = document.getElementById('currencyModal');
    if (!currencyModalEl) return;

    currencyModal = new bootstrap.Modal(currencyModalEl, {
        backdrop: 'static',
        keyboard: false
    });

    const currencySelect   = document.getElementById('currency_select_popup');
    const conversionBox    = document.getElementById('conversion_rate_box');
    const conversionInput  = document.getElementById('conversion_rate_input');
    const selectedRate     = document.getElementById('selected_conversion_rate');
    const selectedSymbol   = document.getElementById('selected_currency_symbol');
    const selectedCurrId   = document.getElementById('selected_currency_id');

    let isEditPage = document.getElementById('is_edit_page')
                        ? parseInt(document.getElementById('is_edit_page').value)
                        : 0;

    // =========================
    // HELPER: Update all currency symbols on page
    // =========================
    function updateCurrencySymbol(symbol) {
        document.querySelectorAll('.currency_symbol_display').forEach(function (el) {
            el.innerText = symbol;
        });
        let modalSymbol = document.getElementById('modal_currency_symbol');
        if (modalSymbol) modalSymbol.innerText = symbol;
    }
    window.updateCurrencySymbol = updateCurrencySymbol; // expose globally

    // =========================
    // HELPER: Show/hide INR columns
    // =========================
    function toggleINRDisplay(symbol) {
        let isINR = (symbol === '₹');
        document.querySelectorAll('.inr_col').forEach(el => {
            el.style.display = isINR ? 'none' : '';
        });
        ['subtotal_inr_wrap', 'other_inr_wrap', 'grand_total_inr_wrap',
         'paid_inr_wrap', 'due_inr_wrap'].forEach(function (id) {
            let el = document.getElementById(id);
            if (el) el.style.display = isINR ? 'none' : '';
        });
    }
    window.toggleINRDisplay = toggleINRDisplay; // expose globally

    // =========================
    // Currency dropdown change handler
    // =========================
    function handleCurrencyChange() {
        let parts  = currencySelect.value.split('|');
        let rate   = parts[1];
        let symbol = parts[2];

        conversionInput.value = rate || '';

        if (symbol && symbol !== '₹') {
            conversionBox.classList.remove('d-none');
        } else {
            conversionBox.classList.add('d-none');
        }
    }

    currencySelect.addEventListener('change', handleCurrencyChange);

    // =========================
    // Pre-select currency in dropdown (edit page)
    // =========================
    function preselectCurrency(currencyId) {
        if (!currencyId) return;
        Array.from(currencySelect.options).forEach(function (opt) {
            if (opt.value.split('|')[0] == currencyId) {
                currencySelect.value = opt.value;
            }
        });
        handleCurrencyChange();
    }

    // =========================
    // ON PAGE LOAD
    // =========================
    if (isEditPage == 0) {
        // New sale: show currency popup immediately
        currencyModal.show();
    } else {
        // Edit sale: apply saved currency silently, no popup
        let existingCurrencyId = selectedCurrId ? selectedCurrId.value : '';
        preselectCurrency(existingCurrencyId);

        let existingSymbol = (selectedSymbol && selectedSymbol.value) ? selectedSymbol.value : '₹';
        updateCurrencySymbol(existingSymbol);
        toggleINRDisplay(existingSymbol);
    }

    // Apply symbol on every load regardless
    let initSymbol = (selectedSymbol && selectedSymbol.value) ? selectedSymbol.value : '₹';
    updateCurrencySymbol(initSymbol);
    toggleINRDisplay(initSymbol);

    // =========================
    // SAVE / Continue button
    // =========================
    document.getElementById('saveCurrency').addEventListener('click', function () {
        let parts  = currencySelect.value.split('|');
        let id     = parts[0];
        let rate   = parseFloat(conversionInput.value || parts[1]);
        let symbol = parts[2];

        if (!symbol) {
            alert('Please select a currency');
            return;
        }

        if (symbol !== '₹' && (!rate || rate <= 0)) {
            alert('Please enter a valid conversion rate');
            return;
        }

        let oldRate = parseFloat((selectedRate && selectedRate.value) ? selectedRate.value : 1);
        let newRate = rate || 1;

        // ✅ Write to all hidden fields
        let currIdDirect = document.getElementById('currency_id_direct');
        let currIdHidden = document.getElementById('currency_id');

        if (currIdDirect) currIdDirect.value = id;
        if (currIdHidden) currIdHidden.value = id;
        if (selectedCurrId) selectedCurrId.value = id;
        if (selectedRate)   selectedRate.value   = newRate;
        if (selectedSymbol) selectedSymbol.value  = symbol;

        // ✅ Update UI
        updateCurrencySymbol(symbol);
        toggleINRDisplay(symbol);

        // ✅ Convert existing cart rows
        if (typeof window.convertExistingRowsCurrency === 'function') {
            window.convertExistingRowsCurrency(oldRate, newRate, symbol);
        }

        // ✅ Recalculate totals
        if (typeof window.cal_row === 'function') {
            window.cal_row();
        }

        // ✅ Close modal cleanly
        currencyModal.hide();
        setTimeout(function () {
            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        }, 300);

        // ✅ Background save to server
        let formData = new FormData();
        formData.append('currency_id', id);
        formData.append('conversion_rate', newRate);

        fetch("{{ route('currency.update.popup') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status !== 'success') {
                console.warn('Currency not saved on server:', data);
            }
        })
        .catch(err => console.error('Background currency save failed:', err));
    });

    // =========================
    // "Change Currency" button
    // =========================
    document.getElementById('openCurrencyModal').addEventListener('click', function () {
        // Re-sync dropdown to currently active currency before opening
        let currentId = selectedCurrId ? selectedCurrId.value : '';
        preselectCurrency(currentId);
        currencyModal.show();
    });

});
</script>
@endsection