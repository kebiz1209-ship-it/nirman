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
                    <h2 class="top-left-header">@lang('index.purchase_return_details')</h2>
                </div>
                <div class="col-md-6">
                    @if (routePermission('purchase_return.print'))
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_return_invoice"
                            data-id="{{ $purchaseReturn->id }}"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            @lang('index.print')</a>
                    @endif
                    @if (routePermission('purchase_return.download'))
                        <a href="{{ route('download_purchase_return_invoice', encrypt_decrypt($purchaseReturn->id, 'encrypt')) }}"
                            target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                                icon="solar:cloud-download-broken"></iconify-icon>
                            @lang('index.download')</a>
                    @endif
                    @if (routePermission('purchase_return.edit') && $purchaseReturn->return_status != 'Final')
                        <a href="{{ route('purchasereturns.edit', encrypt_decrypt($purchaseReturn->id, 'encrypt')) }}"
                            class="btn bg-second-btn"><iconify-icon icon="solar:pen-broken"></iconify-icon>
                            @lang('index.edit')</a>
                    @endif
                    @if (routePermission('purchase_return.index'))
                        <a class="btn bg-second-btn" href="{{ route('purchasereturns.index') }}"><iconify-icon
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
                                <h2 class="color-000000 pt-20 pb-20">@lang('index.purchase_return_invoice')</h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7">@lang('index.supplier_info'):</h4>
                                        @if ($supplier)
                                            <p class="pb-7">{{ $supplier->name }}</p>
                                            <p class="pb-7 rgb-71">{{ $supplier->phone }}</p>
                                            <p class="pb-7 rgb-71">{{ $supplier->email }}</p>
                                            <p class="pb-7 rgb-71">{{ $supplier->address }}</p>
                                        @endif
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7">@lang('index.return_info'):</h4>
                                        <p class="pb-7">
                                            <span class="f-w-600">@lang('index.reference_no'):</span>
                                            {{ $purchaseReturn->reference_no }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.purchase_reference'):</span>
                                            {{ $purchaseReturn->pur_ref_no }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.date'):</span>
                                            {{ getDateFormat($purchaseReturn->date) }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.status'):</span>
                                            <span class="status-draft">{{ $purchaseReturn->return_status }}</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-20">
                                <thead>
                                    <tr>
                                        <th>@lang('index.sn')</th>
                                        <th>@lang('index.item')</th>
                                        <th>@lang('index.unit')</th>
                                        <th>@lang('index.return_qty')</th>
                                        <th>@lang('index.unit_price')</th>
                                        <th>@lang('index.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returnDetails as $key => $detail)
                                        <?php $rm = \App\RawMaterial::find($detail->item_id); ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $rm ? $rm->name : '' }}</td>
                                            <td>{{ $rm ? getRMUnitById($rm->unit) : '' }}</td>
                                            <td>{{ $detail->return_quantity_amount }}</td>
                                            <td>{{ getCurrency($detail->unit_price) }}</td>
                                            <td>{{ getCurrency($detail->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right f-w-600">@lang('index.total_return_amount'):</td>
                                        <td class="f-w-600">{{ getCurrency($purchaseReturn->total_return_amount) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($purchaseReturn->note)
                                <div class="mt-20">
                                    <p><span class="f-w-600">@lang('index.note'):</span> {{ $purchaseReturn->note }}</p>
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
    <script src="{!! $baseURL . 'frequent_changing/js/purchase_return.js' !!}"></script>
@endsection

