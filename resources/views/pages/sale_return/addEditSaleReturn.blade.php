@extends('layouts.app')

@section('script_top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    ?>
@endsection

@section('content')

    <section class="main-content-wrapper">
        <section class="content-header">
            <h3 class="top-left-header">
                {{ isset($title) && $title ? $title : '' }}
            </h3>
        </section>

        @include('utilities.messages')

        <div class="box-wrapper">
            <!-- general form elements -->
            <div class="table-box">
                <!-- form start -->
                <form id="sale_return_form" method="POST"
                    action="{{ isset($saleReturn) && $saleReturn ? route('sale-returns.update', encrypt_decrypt($saleReturn->id, 'encrypt')) : route('sale-returns.store') }}">
                    @csrf
                    @if (isset($saleReturn) && $saleReturn)
                        @method('PATCH')
                    @endif

                    <div>
                        <div class="row">
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>@lang('index.reference_no') <span class="required_star">*</span></label>
                                    <input type="text" name="reference_no" id="reference_no"
                                        class="check_required form-control"
                                        value="{{ isset($saleReturn->reference_no) && $saleReturn->reference_no ? $saleReturn->reference_no : $ref_no }}"
                                        placeholder="Reference No" readonly>
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
                                    <label>@lang('index.select_sale') <span class="required_star">*</span></label>
                                    <select class="form-control select2 check_required" id="sale_id" name="sale_id"
                                        {{ isset($saleReturn) ? 'readonly' : '' }}>
                                        <option value="">@lang('index.select_sale')</option>
                                        @foreach ($sales as $sale)
                                            <option value="{{ $sale->id }}"
                                                {{ (isset($saleReturn->sale_id) && $saleReturn->sale_id == $sale->id) || old('sale_id') == $sale->id ? 'selected' : '' }}
                                                data-customer-id="{{ $sale->customer_id }}"
                                                data-sale-date="{{ $sale->sale_date }}">
                                                {{ $sale->reference_no }} - {{ getDateFormat($sale->sale_date) }} -
                                                {{ getCustomerNameById($sale->customer_id) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none"></div>
                                    @if ($errors->has('sale_id'))
                                        <div class="error_alert text-danger">
                                            {{ $errors->first('sale_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>@lang('index.customers') <span class="required_star">*</span></label>
                                    <input type="text" id="customer_name" class="form-control" readonly
                                        value="{{ isset($saleReturn) && $saleReturn->customer_id ? getCustomerNameById($saleReturn->customer_id) : '' }}">
                                    <input type="hidden" name="customer_id" id="customer_id"
                                        value="{{ isset($saleReturn) && $saleReturn->customer_id ? $saleReturn->customer_id : old('customer_id') }}">
                                    <div class="text-danger customerErr d-none"></div>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>@lang('index.return_date') <span class="required_star">*</span></label>
                                    <input type="text" name="date" id="date"
                                        class="form-control customDatepicker check_required" readonly
                                        placeholder="Return Date"
                                        value="{{ isset($saleReturn->return_date) && $saleReturn->return_date ? $saleReturn->return_date : old('date', date('Y-m-d')) }}">
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
                                    <label>@lang('index.sale_date')</label>
                                    <input type="text" id="sale_date" class="form-control" readonly
                                        value="{{ isset($saleReturn->sale_date) ? getDateFormat($saleReturn->sale_date) : '' }}">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2 col-md-4">
                                <div class="form-group">
                                    <label>@lang('index.return_status') <span class="required_star">*</span></label>
                                    <select class="form-control select2 check_required" id="return_status" name="return_status">
                                        <option value="Draft"
                                            {{ isset($saleReturn->return_status) && $saleReturn->return_status == 'Draft' ? ' selected' : '' }}>
                                            Draft
                                        </option>
                                        <option value="Final"
                                            {{ isset($saleReturn->return_status) && $saleReturn->return_status == 'Final' ? ' selected' : '' }}>
                                            Final
                                        </option>
                                    </select>
                                    <div class="text-danger d-none"></div>
                                    @if ($errors->has('return_status'))
                                        <div class="error_alert text-danger">
                                            {{ $errors->first('return_status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" id="return_cart">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-5 text-start">@lang('index.sn')</th>
                                                <th class="w-25">@lang('index.finished_product')(@lang('index.code'))</th>
                                                <th class="w-10 text-center">@lang('index.sold_qty')</th>
                                                <th class="w-10 text-center">@lang('index.returned_qty')</th>
                                                <th class="w-10 text-center">@lang('index.available_return_quantity')</th>
                                                <th class="w-15">@lang('index.sale_price')<span class="required_star">*</span></th>
                                                <th class="w-15">@lang('index.return_quantity')<span class="required_star">*</span></th>
                                                <th class="w-15">@lang('index.total')</th>
                                                <th class="w-5 ir_txt_center">@lang('index.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody class="add_tr">
                                            @if (isset($returnDetails) && $returnDetails)
                                                @foreach ($returnDetails as $key => $value)
                                                    <?php
                                                    $productInfo = getFinishedProductInfo($value->product_id);
                                                    $saleDetail = $value->sale_detail_id ? \App\SaleDetail::find($value->sale_detail_id) : null;
                                                    $soldQty = $saleDetail ? $saleDetail->product_quantity : 0;
                                                    $returnedQty = getTotalSaleReturnedQuantity($value->sale_id, $value->product_id, $value->sale_detail_id);
                                                    $availableQty = $soldQty - $returnedQty + $value->product_quantity;
                                                    $manufactureInfo = $value->manufacture_id != null ? getManufactureInfo($value->manufacture_id) : null;
                                                    ?>
                                                    <tr class="rowCount" data-id="{{ $value->product_id }}" data-sale-detail-id="{{ $value->sale_detail_id }}">
                                                        <td class="width_1_p text-start">
                                                            <p class="set_sn">{{ $key + 1 }}</p>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" value="{{ $value->product_id }}" name="selected_product_id[]">
                                                            <input type="hidden" value="{{ $value->sale_detail_id }}" name="sale_detail_id[]">
                                                            <input type="hidden" value="{{ $value->manufacture_id }}" name="manufacture_id[]">
                                                            <span>{{ $productInfo->name }}({{ $productInfo->code }})</span>
                                                            @if ($manufactureInfo && $manufactureInfo->expiry_days !== null && $manufactureInfo->complete_date !== null && $manufactureInfo->expiry_days !== 0)
                                                                <br><small>Expiry Date: {{ getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days)) }}</small>
                                                            @endif
                                                            @if ($manufactureInfo && $manufactureInfo->batch_no !== null && $manufactureInfo->batch_no !== '')
                                                                <br><small>Batch Number: {{ $manufactureInfo->batch_no }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="sold_qty text-center">{{ number_format($soldQty, 2) }}</td>
                                                        <td class="returned_qty text-center">{{ number_format($returnedQty - $value->product_quantity, 2) }}</td>
                                                        <td class="available_qty text-center">{{ number_format($availableQty, 2) }}</td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" name="unit_price[]"
                                                                    onfocus="this.select();"
                                                                    class="check_required form-control integerchk input_aligning unit_price_c cal_row"
                                                                    placeholder="Unit Price" 
                                                                    value="{{ $value->unit_price ? number_format($value->unit_price, 2, '.', '') : '0.00' }}"
                                                                    id="unit_price_{{ $key + 1 }}">
                                                                <span class="input-group-text">{{ $setting->currency }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" data-countid="{{ $key + 1 }}" id="qty_{{ $key + 1 }}"
                                                                    name="quantity_amount[]" onfocus="this.select();"
                                                                    class="check_required form-control integerchk input_aligning qty_c cal_row"
                                                                    value="{{ $value->product_quantity ? number_format($value->product_quantity, 2, '.', '') : '0.00' }}"
                                                                    data-max="{{ $availableQty }}"
                                                                    placeholder="Return Qty">
                                                                <span class="input-group-text">{{ getRMUnitById($productInfo->unit) }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="item_total" style="font-size: 14px; font-weight: 500;">
                                                            {{ getCurrency($value->total_amount) }}
                                                            <input type="hidden" name="total[]" class="item_total_value" value="{{ $value->total_amount ? $value->total_amount : 0 }}">
                                                        </td>
                                                        <td class="ir_txt_center"><a
                                                                class="btn btn-xs del_row dlt_button"><iconify-icon
                                                                    icon="solar:trash-bin-minimalistic-broken"></iconify-icon>
                                                            </a></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="quotation_page" value="0" />
                        <div class="row mt-4">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>@lang('index.note')</label>
                                            <textarea name="note" id="note" class="form-control" placeholder="Note" rows="3">{{ isset($saleReturn->note) ? $saleReturn->note : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row w-86 mb-2">
                                    <label class="custom_label">@lang('index.subtotal')</label>
                                    <div class="input-group">
                                        <input type="text" name="subtotal" id="subtotal"
                                            class="form-control" readonly
                                            value="{{ isset($saleReturn->subtotal) && $saleReturn->subtotal ? $saleReturn->subtotal : 0 }}"
                                            placeholder="Sub Total">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                    </div>
                                </div>
                                <div class="row w-86 mb-2">
                                    <label class="custom_label">@lang('index.other')</label>
                                    <div class="input-group">
                                        <input type="text" name="other" id="other"
                                            class="form-control integerchk cal_row"
                                            value="{{ isset($saleReturn->other) ? $saleReturn->other : 0 }}"
                                            placeholder="Other">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                    </div>
                                </div>
                                <div class="row w-86 mb-2">
                                    <div class="form-group">
                                        <label class="custom_label">@lang('index.discount')</label>
                                        <input type="text" name="discount" id="discount"
                                            class="form-control discount cal_row"
                                            data-special_ignore="ignore"
                                            value="{{ isset($saleReturn->discount) ? $saleReturn->discount : 0 }}"
                                            placeholder="Discount">
                                    </div>
                                </div>
                                <div class="row w-86 mb-2">
                                    <label class="custom_label">@lang('index.g_total')</label>
                                    <div class="input-group">
                                        <input type="text" name="grand_total" id="grand_total"
                                            class="form-control" readonly
                                            value="{{ isset($saleReturn->grand_total) && $saleReturn->grand_total ? $saleReturn->grand_total : 0 }}"
                                            placeholder="G.Total">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                    </div>
                                </div>

                                <div class="row w-86 mb-2">
                                    <label class="custom_label">@lang('index.paid') <span
                                            class="required_star">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="paid" id="paid"
                                            class="form-control check_required integerchk cal_row"
                                            placeholder="Paid"
                                            onfocus="select()"
                                            value="{{ isset($saleReturn->paid) ? $saleReturn->paid : 0 }}">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
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
                                                            {{ isset($saleReturn->account_id) && $saleReturn->account_id == $value->id ? 'selected' : '' }}
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
                                            name="change_currency" value="1" {{ isset($saleReturn->converted_currency_id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="change_currency">
                                            @lang('index.change_currency')
                                        </label>
                                    </div>
                                </div>
                                <div class="{{ isset($saleReturn->converted_currency_id) ? '' : 'd-none' }}" id="currency_section">
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
                                                            {{ (isset($saleReturn->converted_currency_id) && $saleReturn->converted_currency_id == $value->id) || old('currency') == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}|{{ $value->conversion_rate }}|{{ $value->symbol }}">{{ $value->symbol }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger d-none"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="currency_id" id="currency_id" value="{{ isset($saleReturn->converted_currency_id) ? $saleReturn->converted_currency_id : old('converted_currency_id') }}" />
                                    <div class="row mb-1">
                                        <label class="custom_label">@lang('index.converted_amount')</label>
                                        <div class="input-group">
                                            <input type="text" name="converted_amount" id="converted_amount"
                                                class="form-control @error('converted_amount') is-invalid @enderror integerchk converted_amount check"
                                                readonly placeholder="Converted Amount"
                                                value="{{ isset($saleReturn->converted_amount) ? $saleReturn->converted_amount : old('converted_amount') }}">
                                            <span class="input-group-text converted_amount_currency">{{ $setting->currency }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row w-86 mb-2">
                                    <label class="custom_label">@lang('index.due')</label>
                                    <div class="input-group">
                                        <input type="text" name="due" id="due"
                                            class="form-control integerchk customer_current_due check"
                                            readonly
                                            placeholder="Due"
                                            value="{{ isset($saleReturn->due) ? $saleReturn->due : 0 }}">
                                        <span class="input-group-text">{{ $setting->currency }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')</button>
                            <a class="btn bg-second-btn" href="{{ route('sale-returns.index') }}"><iconify-icon
                                    icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <?php
    $baseURL = getBaseURL();
    ?>
    <script type="text/javascript" src="{!! $baseURL . 'frequent_changing/js/sale_return.js' !!}"></script>
    <script type="text/javascript" src="{!! $baseURL . 'frequent_changing/js/customer.js' !!}"></script>
    <script>
        $(document).ready(function() {
            // Initialize on page load if editing
            @if (isset($saleReturn) && $saleReturn)
                var saleId = $('#sale_id').val();
                if (saleId) {
                    loadSaleItems(saleId);
                }
            @endif
        });
    </script>
@endsection

