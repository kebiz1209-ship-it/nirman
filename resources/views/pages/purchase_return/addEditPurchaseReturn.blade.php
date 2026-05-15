@extends('layouts.app')

@section('script_top')
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
            <div class="table-box">
                <form id="purchase_return_form" method="POST"
                    action="{{ isset($purchaseReturn) && $purchaseReturn ? route('purchasereturns.update', $purchaseReturn->id) : route('purchasereturns.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($purchaseReturn) && $purchaseReturn)
                        @method('PATCH')
                    @endif

                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.reference_no') <span class="required_star">*</span></label>
                                <input type="text" name="reference_no" id="reference_no"
                                    class="check_required form-control @error('reference_no') is-invalid @enderror"
                                    placeholder="Reference No"
                                    value="{{ isset($purchaseReturn->reference_no) ? $purchaseReturn->reference_no : $ref_no }}"
                                    readonly>
                                @error('reference_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.select_purchase') <span class="required_star">*</span></label>
                                <select class="form-control @error('pur_ref_no') is-invalid @enderror select2"
                                    id="purchase_id" name="pur_ref_no" {{ isset($purchaseReturn) ? 'readonly' : '' }}>
                                    <option value="">@lang('index.select_purchase')</option>
                                    @foreach ($purchases as $purchase)
                                        <option value="{{ $purchase->reference_no }}"
                                            {{ (isset($purchaseReturn->pur_ref_no) && $purchaseReturn->pur_ref_no == $purchase->reference_no) || old('pur_ref_no') == $purchase->reference_no ? 'selected' : '' }}
                                            data-purchase-id="{{ $purchase->id }}"
                                            data-supplier-id="{{ $purchase->supplier }}"
                                            data-purchase-date="{{ $purchase->date }}">
                                            {{ $purchase->reference_no }} - {{ getDateFormat($purchase->date) }} -
                                            {{ getSupplierName($purchase->supplier) }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="supplier_id" id="supplier_id"
                                    value="{{ isset($purchaseReturn->supplier_id) ? $purchaseReturn->supplier_id : old('supplier_id') }}">
                                @error('pur_ref_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.supplier')</label>
                                <input type="text" id="supplier_name" class="form-control" readonly
                                    value="{{ isset($purchaseReturn) && $purchaseReturn->supplier_id ? getSupplierName($purchaseReturn->supplier_id) : '' }}">
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.return_date') <span class="required_star">*</span></label>
                                <input type="text" name="date" id="return_date"
                                    class="form-control @error('date') is-invalid @enderror customDatepicker" readonly
                                    placeholder="Return Date"
                                    value="{{ isset($purchaseReturn->date) ? $purchaseReturn->date : old('date', date('Y-m-d')) }}">
                                @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.purchase_date')</label>
                                <input type="text" id="purchase_date" class="form-control" readonly
                                    value="{{ isset($purchaseReturn->purchase_date) ? getDateFormat($purchaseReturn->purchase_date) : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>@lang('index.items_to_return') <span class="required_star">*</span></label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="return_items_table">
                                        <thead>
                                            <tr>
                                                <th class="width_1_p">@lang('index.sn')</th>
                                                <th class="w-25">@lang('index.item')</th>
                                                <th class="w-10">@lang('index.unit')</th>
                                                <th class="w-15">@lang('index.purchased_qty')</th>
                                                <th class="w-15">@lang('index.returned_qty')</th>
                                                <th class="w-15">@lang('index.available_qty')</th>
                                                <th class="w-10">@lang('index.unit_price')</th>
                                                <th class="w-10">@lang('index.return_qty') <span class="required_star">*</span>
                                                </th>
                                                <th class="w-15">@lang('index.total')</th>
                                                <th class="w-5">@lang('index.actions')</th>
                                            </tr>
                                        </thead>
                                        <tbody id="return_items_tbody">
                                            @if (isset($returnDetails) && $returnDetails->count() > 0)
                                                @foreach ($returnDetails as $key => $detail)
                                                    <?php
                                                    $rm = \App\RawMaterial::find($detail->item_id);
                                                    $purchaseItem = \App\RMPurchase_model::where('purchase_id', $originalPurchase->id)->where('rmaterials_id', $detail->item_id)->where('del_status', 'Live')->first();
                                                    $returnedQty = getTotalReturnedQuantity($detail->item_id, $originalPurchase->id);
                                                    $availableQty = $purchaseItem ? $purchaseItem->quantity_amount - $returnedQty + $detail->return_quantity_amount : 0;
                                                    ?>
                                                    <tr class="return_item_row" data-item-id="{{ $detail->item_id }}">
                                                        <td class="c_center">
                                                            <span class="row_sn">{{ $key + 1 }}</span>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="item_id[]"
                                                                value="{{ $detail->item_id }}">
                                                            <span>{{ $rm ? $rm->name : '' }}</span>
                                                        </td>
                                                        <td>{{ $rm ? getRMUnitById($rm->unit) : '' }}</td>
                                                        <td class="purchased_qty">
                                                            {{ $purchaseItem ? $purchaseItem->quantity_amount : 0 }}</td>
                                                        <td class="returned_qty">
                                                            {{ $returnedQty - $detail->return_quantity_amount }}</td>
                                                        <td class="available_qty">{{ $availableQty }}</td>
                                                        <td>
                                                            <input type="number" name="unit_price[]"
                                                                class="form-control unit_price" step="0.01"
                                                                value="{{ $detail->unit_price }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="return_quantity_amount[]"
                                                                class="form-control return_qty" step="0.01"
                                                                max="{{ $availableQty }}"
                                                                value="{{ $detail->return_quantity_amount }}" required>
                                                        </td>
                                                        <td class="item_total" style="font-size: 14px; font-weight: 500;">
                                                            {{ getCurrency($detail->total) }}
                                                            <input type="hidden" name="total[]" class="item_total_value" value="{{ $detail->total }}">
                                                        </td>
                                                        <td class="ir_txt_center">
                                                            <a href="#"
                                                                class="btn btn-xs text-danger remove_item_row">
                                                                <iconify-icon
                                                                    icon="solar:trash-bin-minimalistic-broken"></iconify-icon>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div id="no_items_message" class="alert alert-info mt-2" style="display: none;">
                                    @lang('index.select_purchase_to_load_items')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>@lang('index.note')</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" placeholder="Note">{{ isset($purchaseReturn->note) ? $purchaseReturn->note : old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row mb-1">
                                <label class="custom_label">@lang('index.total_return_amount') <span
                                        class="required_star">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="total_return_amount" id="total_return_amount"
                                        class="form-control @error('total_return_amount') is-invalid @enderror" readonly
                                        placeholder="Total"
                                        value="{{ isset($purchaseReturn->total_return_amount) ? $purchaseReturn->total_return_amount : old('total_return_amount', 0) }}">
                                    <span class="input-group-text">{{ $setting->currency }}</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label class="custom_label">@lang('index.account') <span
                                        class="required_star">*</span></label>
                                <div class="d-flex align-items-center">
                                    <div class="w-100">
                                        <select tabindex="2"
                                            class="form-control @error('account') is-invalid @enderror select2"
                                            id="accounts" name="account">
                                            <option value="">@lang('index.select')</option>
                                            @foreach ($accounts as $value)
                                                <option
                                                    {{ (isset($obj->account) && $obj->account == $value->id) || old('account') == $value->id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger d-none"></div>
                                    </div>

                                    <div class="paid_err_msg_contnr">
                                        <p id="account_err_msg"></p>
                                    </div>
                                    @error('account')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="form-group">
                                    <label>@lang('index.status') <span class="required_star">*</span></label>
                                    <select class="form-control @error('return_status') is-invalid @enderror select2" name="return_status" id="return_status">
                                        <option value="Draft"
                                            {{ (isset($purchaseReturn->return_status) && $purchaseReturn->return_status == 'Draft') || old('return_status') == 'Draft' ? 'selected' : '' }}>
                                            @lang('index.draft')
                                        </option>
                                        <option value="Final"
                                            {{ (isset($purchaseReturn->return_status) && $purchaseReturn->return_status == 'Final') || old('return_status') == 'Final' ? 'selected' : '' }}>
                                            @lang('index.final')
                                        </option>
                                    </select>
                                    <div class="text-danger d-none"></div>
                                    @error('return_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')</button>
                            <a class="btn bg-second-btn" href="{{ route('purchasereturns.index') }}"><iconify-icon
                                    icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{!! $baseURL . 'frequent_changing/js/purchase_return.js' !!}"></script>
    <script>
        $(document).ready(function() {
            // Initialize date picker
            if ($('.customDatepicker').length) {
                $('.customDatepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true
                });
            }

            // Initialize select2
            if ($('.select2').length) {
                $('.select2').select2();
            }

            @if (isset($purchaseReturn) && $purchaseReturn)
                // If editing, load items
                var purchaseId = $('#purchase_id').find('option:selected').data('purchase-id');
                if (purchaseId) {
                    loadPurchaseItems(purchaseId);
                }
            @endif
        });
    </script>
@endsection
