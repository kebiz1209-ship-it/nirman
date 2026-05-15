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
                <form id="transfer_form" method="POST" action="{{ route('raw-material-transfers.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 mb-2 col-md-4">
                            <div class="form-group">
                                <label>@lang('index.transfer_reference_no') <span class="required_star">*</span></label>
                                <input type="text" name="transfer_reference_no" id="transfer_reference_no"
                                    class="check_required form-control @error('transfer_reference_no') is-invalid @enderror"
                                    placeholder="Transfer Reference No"
                                    value="{{ old('transfer_reference_no', $ref_no) }}" readonly>
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
                                            {{ (old('from_outlet_id', $currentOutletId) == $outlet->id) ? 'selected' : '' }}>
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
                                            {{ old('to_outlet_id') == $outlet->id ? 'selected' : '' }}>
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
                                    value="{{ old('transfer_date', date('Y-m-d')) }}">
                                @error('transfer_date')
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
                                        <!-- Items will be added here -->
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
                                            placeholder="Note">{{ old('note') }}</textarea>
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
@endsection
