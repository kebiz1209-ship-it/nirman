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
                <form id="transfer_form" method="POST"
                    action="{{ route('raw-material-transfers.update', encrypt_decrypt($transfer->id, 'encrypt')) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.transfer_reference_no') <span class="required_star">*</span></label>
                                <input type="text" name="transfer_reference_no" id="transfer_reference_no"
                                    class="check_required form-control @error('transfer_reference_no') is-invalid @enderror"
                                    placeholder="Transfer Reference No"
                                    value="{{ old('transfer_reference_no', $transfer->transfer_reference_no) }}" readonly>
                                @error('transfer_reference_no')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.from_outlet') <span class="required_star">*</span></label>
                                <select class="form-control @error('from_outlet_id') is-invalid @enderror select2"
                                    id="from_outlet_id" name="from_outlet_id" required>
                                    <option value="">@lang('index.select')</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{ $outlet->id }}"
                                            {{ (old('from_outlet_id', $transfer->from_outlet_id) == $outlet->id) ? 'selected' : '' }}>
                                            {{ $outlet->outlet_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('from_outlet_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.to_outlet') <span class="required_star">*</span></label>
                                <select class="form-control @error('to_outlet_id') is-invalid @enderror select2"
                                    id="to_outlet_id" name="to_outlet_id" required>
                                    <option value="">@lang('index.select')</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{ $outlet->id }}"
                                            {{ (old('to_outlet_id', $transfer->to_outlet_id) == $outlet->id) ? 'selected' : '' }}>
                                            {{ $outlet->outlet_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('to_outlet_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.transfer_date') <span class="required_star">*</span></label>
                                <input type="text" name="transfer_date" id="transfer_date"
                                    class="form-control @error('transfer_date') is-invalid @enderror customDatepicker" readonly
                                    placeholder="Transfer Date"
                                    value="{{ old('transfer_date', $transfer->transfer_date) }}">
                                @error('transfer_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.transfer_status') <span class="required_star">*</span></label>
                                <select class="form-control @error('transfer_status') is-invalid @enderror select2" name="transfer_status"
                                    id="transfer_status">
                                    <option value="Draft"
                                        {{ (old('transfer_status', $transfer->transfer_status) == 'Draft') ? 'selected' : '' }}>
                                        @lang('index.draft')</option>
                                    <option value="Pending"
                                        {{ (old('transfer_status', $transfer->transfer_status) == 'Pending') ? 'selected' : '' }}>
                                        @lang('index.pending')</option>
                                    <option value="In Transit"
                                        {{ (old('transfer_status', $transfer->transfer_status) == 'In Transit') ? 'selected' : '' }}>
                                        @lang('index.in_transit')</option>
                                    <option value="Completed"
                                        {{ (old('transfer_status', $transfer->transfer_status) == 'Completed') ? 'selected' : '' }}>
                                        @lang('index.completed')</option>
                                    <option value="Cancelled"
                                        {{ (old('transfer_status', $transfer->transfer_status) == 'Cancelled') ? 'selected' : '' }}>
                                        @lang('index.cancelled')</option>
                                </select>
                                <div class="text-danger d-none"></div>
                                @error('transfer_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.raw_material') <span class="required_star">*</span></label>
                                <select tabindex="4"
                                    class="form-control @error('rmaterial') is-invalid @enderror select2 select2-hidden-accessible"
                                    name="rmaterial" id="rmaterial">
                                    <option value="">@lang('index.select')</option>
                                    @foreach ($rawMaterials as $rm)
                                        <option
                                            value="{{ $rm->id . '|' . $rm->name . ' (' . $rm->code . ')|' . $rm->name . '|' . ($rm->rate_per_unit ?? 0) . '|' . getPurchaseSaleUnitById($rm->unit) . '|' . $setting->currency }}">
                                            {{ $rm->name . '(' . $rm->code . ')' }}</option>
                                    @endforeach
                                </select>
                                @error('rmaterial')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="transfer_cart">
                                <table class="table">
                                    <thead>
                                        <th class="w-5 text-start">@lang('index.sn')</th>
                                        <th class="w-30">@lang('index.raw_material')(@lang('index.code'))</th>
                                        <th class="w-10">@lang('index.available_stock')</th>
                                        <th class="w-20">@lang('index.unit_price')<span class="required_star">*</span></th>
                                        <th class="w-20">@lang('index.quantity')<span class="required_star">*</span></th>
                                        <th class="w-20">@lang('index.total')</th>
                                        <th class="w-5 ir_txt_center">@lang('index.actions')</th>
                                    </thead>
                                    <tbody class="add_tr">
                                        @if (isset($transferDetails) && $transferDetails)
                                            @foreach ($transferDetails as $key => $value)
                                                <?php
                                                $rm = $value->rawMaterial;
                                                ?>
                                                <tr class="rowCount" data-id="{{ $value->raw_material_id }}">
                                                    <td class="width_1_p text-start">
                                                        <p class="set_sn"></p>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" value="{{ $value->raw_material_id }}"
                                                            name="rm_id[]">
                                                        <span>{{ getRMName($value->raw_material_id) }}</span>
                                                    </td>
                                                    <td class="available_stock_display">-</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" tabindex="5" name="unit_price[]"
                                                                onfocus="this.select();"
                                                                class="check_required form-control integerchk input_aligning unit_price_c cal_row"
                                                                placeholder="Unit Price" value="{{ $value->unit_price }}"
                                                                id="unit_price_1">
                                                            <span class="input-group-text">
                                                                {{ $setting->currency }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" data-countid="1" tabindex="51"
                                                                id="qty_1" name="quantity_amount[]"
                                                                onfocus="this.select();"
                                                                class="check_required form-control integerchk input_aligning qty_c cal_row"
                                                                value="{{ $value->quantity }}"
                                                                placeholder="Qty/Amount">
                                                            <span
                                                                class="input-group-text">{{ getPurchaseSaleUnitById($value->raw_material_id) }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" id="total_1" name="total[]"
                                                                class="form-control total_c"
                                                                value="{{ $value->total_amount }}"
                                                                placeholder="Total" readonly="">
                                                            <span class="input-group-text">
                                                                {{ $setting->currency }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="ir_txt_center"><a
                                                            class="btn btn-xs text-danger del_row"><iconify-icon
                                                                icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label>@lang('index.note')</label>
                                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror"
                                            placeholder="Note">{{ old('note', $transfer->note) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-6 mb-2 d-flex gap-3">
                            <button type="submit" name="submit" value="submit" class="btn bg-blue-btn"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon>@lang('index.submit')</button>
                            <a class="btn bg-second-btn" href="{{ route('raw-material-transfers.index') }}"><iconify-icon
                                    icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="cartPreviewModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        @lang('index.select_raw_materials')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i data-feather="x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">@lang('index.name'): </label>
                            <div class="col-sm-7">
                                <p class="item_name_modal"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-12 control-label custom_label mb-1">@lang('index.unit_price') <span
                                        class="required_star">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" autocomplete="off"
                                        class="form-control @error('title') is-invalid @enderror integerchk1"
                                        onfocus="select();" name="unit_price_modal" id="unit_price_modal"
                                        placeholder="Unit Price" value="">
                                    <input type="hidden" name="item_id_modal" id="item_id_modal" value="">
                                    <input type="hidden" name="item_name_modal" id="item_name_modal" value="">
                                    <input type="hidden" name="item_currency_modal" id="item_currency_modal"
                                        value="">
                                    <input type="hidden" name="item_unit_modal" id="item_unit_modal" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-12 control-label custom_label mb-1">@lang('index.quantity') <span
                                        class="required_star">*</span></label>
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <input type="number" autocomplete="off" min="1"
                                            class="form-control @error('title') is-invalid @enderror integerchk1"
                                            onfocus="select();" name="qty_modal" id="qty_modal" placeholder="Quantity"
                                            value="1">
                                        <span class="input-group-text modal_unit_name" id="basic-addon2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ir_d_block">
                    <button type="button" class="btn bg-blue-btn" id="addToCart"><iconify-icon
                            icon="solar:add-circle-broken"></iconify-icon>@lang('index.add_to_cart')
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <?php
    $baseURL = getBaseURL();
    ?>
    <script type="text/javascript" src="{!! $baseURL . 'frequent_changing/js/addRMTransfer.js' !!}"></script>
    <script>
        $(document).ready(function() {
            // Load stock for existing items on page load
            setTimeout(function() {
                $(".rowCount").each(function() {
                    let row = $(this);
                    let rawMaterialId = row.find('input[name="rm_id[]"]').val();
                    let fromOutletId = $("#from_outlet_id").val();
                    
                    if (rawMaterialId && fromOutletId) {
                        $.ajax({
                            url: '{{ route("getRawMaterialStockForTransfer") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                raw_material_id: rawMaterialId,
                                outlet_id: fromOutletId
                            },
                            success: function (response) {
                                if (response.stock !== undefined) {
                                    row.find(".available_stock_display").text(parseFloat(response.stock).toFixed(2) + " " + response.unit);
                                }
                            },
                            error: function () {
                                row.find(".available_stock_display").text("-");
                            }
                        });
                    }
                });
            }, 500);
        });
    </script>
@endsection
