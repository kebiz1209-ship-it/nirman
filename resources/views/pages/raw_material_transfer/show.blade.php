@extends('layouts.app')
@section('content')
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <link rel="stylesheet" href="{{ getBaseURL() . 'frequent_changing/css/pdf_common.css' }}">
    <section class="main-content-wrapper">
        @include('utilities.messages')
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header">@lang('index.view_raw_material_transfer')</h2>
                </div>
                <div class="col-md-6">
                    @if (routePermission('raw-material-transfer.print'))
                        <a href="{{ route('raw-material-transfers.print', encrypt_decrypt($transfer->id, 'encrypt')) }}"
                            target="_blank" class="btn bg-second-btn"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            @lang('index.print')</a>
                    @endif
                    @if (routePermission('raw-material-transfer.edit') && $transfer->transfer_status == 'Draft')
                        <a href="{{ route('raw-material-transfers.edit', encrypt_decrypt($transfer->id, 'encrypt')) }}"
                            class="btn bg-second-btn"><iconify-icon icon="solar:pen-broken"></iconify-icon>
                            @lang('index.edit')</a>
                    @endif
                    @if (in_array($transfer->transfer_status, ['Draft', 'Pending']))
                        @if (routePermission('raw-material-transfer.approve'))
                            <a href="javascript:void(0);" class="btn bg-second-btn approve-transfer"
                                data-id="{{ encrypt_decrypt($transfer->id, 'encrypt') }}"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon> @lang('index.approve')</a>
                        @endif
                    @endif
                    @if (in_array($transfer->transfer_status, ['Pending', 'In Transit']))
                        @if (routePermission('raw-material-transfer.complete'))
                            <a href="javascript:void(0);" class="btn bg-second-btn complete-transfer"
                                data-id="{{ encrypt_decrypt($transfer->id, 'encrypt') }}"><iconify-icon
                                    icon="solar:check-circle-broken"></iconify-icon> @lang('index.complete')</a>
                        @endif
                    @endif
                    @if (routePermission('raw-material-transfer.index'))
                        <a class="btn bg-second-btn" href="{{ route('raw-material-transfers.index') }}"><iconify-icon
                                icon="solar:round-arrow-left-broken"></iconify-icon>@lang('index.back')</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="content">
            <div class="col-md-12">
                <div class="card" id="dash_0">
                    <div class="card-body p30">
                        <div class="m-auto b-r-5">
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h3 class="pb-7">{{ getCompanyInfo()->company_name }}</h3>
                                        <p class="pb-7 rgb-71">{{ safe(getCompanyInfo()->address) }}</p>
                                        <p class="pb-7 rgb-71">@lang('index.email') : {{ safe(getCompanyInfo()->email) }}</p>
                                        <p class="pb-7 rgb-71">@lang('index.phone') : {{ safe(getCompanyInfo()->phone) }}</p>
                                    </td>
                                    <td class="w-50 text-right">
                                        <img src="{!! getBaseURL() .
                                            (isset(getWhiteLabelInfo()->logo) ? 'uploads/white_label/' . getWhiteLabelInfo()->logo : 'images/logo.png') !!}" alt="site-logo">
                                    </td>
                                </tr>
                            </table>
                            <div class="text-center pt-10 pb-10">
                                <h2 class="color-000000 pt-20 pb-20">@lang('index.raw_material_transfer')</h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7">@lang('index.from_outlet'):</h4>
                                        @if ($transfer->fromOutlet)
                                            <p class="pb-7">{{ $transfer->fromOutlet->outlet_name }}</p>
                                            <p class="pb-7 rgb-71">{{ $transfer->fromOutlet->outlet_address }}</p>
                                            <p class="pb-7 rgb-71">{{ $transfer->fromOutlet->outlet_phone }}</p>
                                        @endif
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7">@lang('index.to_outlet'):</h4>
                                        @if ($transfer->toOutlet)
                                            <p class="pb-7">{{ $transfer->toOutlet->outlet_name }}</p>
                                            <p class="pb-7 rgb-71">{{ $transfer->toOutlet->outlet_address }}</p>
                                            <p class="pb-7 rgb-71">{{ $transfer->toOutlet->outlet_phone }}</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7">@lang('index.transfer_info'):</h4>
                                        <p class="pb-7">
                                            <span class="f-w-600">@lang('index.transfer_reference_no'):</span>
                                            {{ $transfer->transfer_reference_no }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.transfer_date'):</span>
                                            {{ getDateFormat($transfer->transfer_date) }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.transfer_status'):</span>
                                            <span class="status-draft">{{ $transfer->transfer_status }}</span>
                                        </p>
                                        @if ($transfer->approved_by)
                                            <p class="pb-7 rgb-71">
                                                <span class="f-w-600">@lang('index.approved_by'):</span>
                                                {{ getUserName($transfer->approved_by) }}
                                            </p>
                                            <p class="pb-7 rgb-71">
                                                <span class="f-w-600">@lang('index.approved_at'):</span>
                                                {{ $transfer->approved_at ? getDateFormat($transfer->approved_at) : '-' }}
                                            </p>
                                        @endif
                                        @if ($transfer->received_by)
                                            <p class="pb-7 rgb-71">
                                                <span class="f-w-600">@lang('index.received_by'):</span>
                                                {{ getUserName($transfer->received_by) }}
                                            </p>
                                            <p class="pb-7 rgb-71">
                                                <span class="f-w-600">@lang('index.received_at'):</span>
                                                {{ $transfer->received_at ? getDateFormat($transfer->received_at) : '-' }}
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-20">
                                <thead>
                                    <tr>
                                        <th>@lang('index.sn')</th>
                                        <th>@lang('index.raw_material')</th>
                                        <th>@lang('index.unit')</th>
                                        <th>@lang('index.quantity')</th>
                                        <th>@lang('index.unit_price')</th>
                                        <th>@lang('index.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferDetails as $key => $detail)
                                        <?php $rm = $detail->rawMaterial; ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $rm ? $rm->name : '' }}</td>
                                            <td>{{ $rm && $rm->unit ? getRMUnitById($rm->unit) : '' }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ getCurrency($detail->unit_price) }}</td>
                                            <td>{{ getCurrency($detail->total_amount) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right f-w-600">@lang('index.grand_total'):</td>
                                        <td class="f-w-600">{{ getCurrency($transferDetails->sum('total_amount')) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($transfer->note)
                                <div class="mt-20">
                                    <p><span class="f-w-600">@lang('index.note'):</span> {{ $transfer->note }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('script')
    <script src="{!! $baseURL . 'assets/datatable_custom/jquery-3.3.1.js' !!}"></script>
    <script>
        $(document).ready(function() {
            let hidden_alert = $("#hidden_alert").val();
            let hidden_cancel = $("#hidden_cancel").val();
            let hidden_ok = $("#hidden_ok").val();
            let are_you_sure = '@lang('index.are_you_sure')';

            $('.approve-transfer').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: hidden_alert + "!",
                    text: are_you_sure,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: hidden_ok,
                    cancelButtonText: hidden_cancel,
                    confirmButtonColor: "#3c8dbc",
                }, function(isConfirm) {
                    if (isConfirm) {
                        var form = $('<form>', {
                            'method': 'POST',
                            'action': '/raw-material-transfers/' + id + '/approve'
                        });
                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }));
                        $('body').append(form);
                        form.submit();
                    }
                });
            });

            $('.complete-transfer').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: hidden_alert + "!",
                    text: are_you_sure,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: hidden_ok,
                    cancelButtonText: hidden_cancel,
                    confirmButtonColor: "#3c8dbc",
                }, function(isConfirm) {
                    if (isConfirm) {
                        var form = $('<form>', {
                            'method': 'POST',
                            'action': '/raw-material-transfers/' + id + '/complete'
                        });
                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }));
                        $('body').append(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

