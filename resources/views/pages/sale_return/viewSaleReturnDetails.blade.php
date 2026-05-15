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
                    <h2 class="top-left-header">@lang('index.view_sale_return_details')</h2>
                </div>
                <div class="col-md-6">
                    @if (routePermission('sale-return.print-invoice'))
                        <a href="javascript:void();" target="_blank" class="btn bg-second-btn print_return_invoice"
                            data-id="{{ $saleReturn->id }}"><iconify-icon icon="solar:printer-broken"></iconify-icon>
                            @lang('index.print')</a>
                    @endif
                    @if (routePermission('sale-return.download-invoice'))
                        <a href="{{ route('sale_returns.download_return_invoice', encrypt_decrypt($saleReturn->id, 'encrypt')) }}"
                            target="_blank" class="btn bg-second-btn print_btn"><iconify-icon
                                icon="solar:cloud-download-broken"></iconify-icon>
                            @lang('index.download')</a>
                    @endif
                    @if (routePermission('sale-return.edit') && $saleReturn->return_status != 'Final')
                        <a href="{{ route('sale-returns.edit', encrypt_decrypt($saleReturn->id, 'encrypt')) }}"
                            class="btn bg-second-btn"><iconify-icon icon="solar:pen-broken"></iconify-icon>
                            @lang('index.edit')</a>
                    @endif
                    @if (routePermission('sale-return.index'))
                        <a class="btn bg-second-btn" href="{{ route('sale-returns.index') }}"><iconify-icon
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
                                <h2 class="color-000000 pt-20 pb-20">@lang('index.sale_return_invoice')</h2>
                            </div>
                            <table>
                                <tr>
                                    <td class="w-50">
                                        <h4 class="pb-7">@lang('index.customer_info'):</h4>
                                        @if ($customer)
                                            <p class="pb-7">{{ $customer->name }}</p>
                                            <p class="pb-7 rgb-71">{{ $customer->phone }}</p>
                                            <p class="pb-7 rgb-71">{{ $customer->email }}</p>
                                            <p class="pb-7 rgb-71">{{ $customer->address }}</p>
                                        @endif
                                    </td>
                                    <td class="w-50 text-right">
                                        <h4 class="pb-7">@lang('index.return_info'):</h4>
                                        <p class="pb-7">
                                            <span class="f-w-600">@lang('index.reference_no'):</span>
                                            {{ $saleReturn->reference_no }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.original_sale'):</span>
                                            <a href="{{ route('sales.show', encrypt_decrypt($saleReturn->sale_id, 'encrypt')) }}" target="_blank">
                                                {{ $saleReturn->sale_ref_no }}
                                            </a>
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.return_date'):</span>
                                            {{ getDateFormat($saleReturn->return_date) }}
                                        </p>
                                        <p class="pb-7 rgb-71">
                                            <span class="f-w-600">@lang('index.status'):</span>
                                            <span class="status-draft">{{ $saleReturn->return_status }}</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-20">
                                <thead>
                                    <tr>
                                        <th>@lang('index.sn')</th>
                                        <th>@lang('index.product')(@lang('index.code'))</th>
                                        <th>@lang('index.unit')</th>
                                        <th>@lang('index.return_quantity')</th>
                                        <th>@lang('index.unit_price')</th>
                                        <th>@lang('index.total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($returnDetails as $key => $detail)
                                        <?php
                                        $productInfo = getFinishedProductInfo($detail->product_id);
                                        $manufactureInfo = $detail->manufacture_id != null ? getManufactureInfo($detail->manufacture_id) : null;
                                        ?>
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $productInfo->name }}({{ $productInfo->code }})
                                                @if ($manufactureInfo && $manufactureInfo->expiry_days !== null && $manufactureInfo->complete_date !== null && $manufactureInfo->expiry_days !== 0)
                                                    <br><small>Expiry Date: {{ getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days)) }}</small>
                                                @endif
                                                @if ($manufactureInfo && $manufactureInfo->batch_no !== null && $manufactureInfo->batch_no !== '')
                                                    <br><small>Batch Number: {{ $manufactureInfo->batch_no }}</small>
                                                @endif
                                            </td>
                                            <td>{{ getRMUnitById($productInfo->unit) }}</td>
                                            <td>{{ $detail->product_quantity }}</td>
                                            <td>{{ getAmtCustom($detail->unit_price) }}</td>
                                            <td>{{ getAmtCustom($detail->total_amount) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-right f-w-600">@lang('index.subtotal'):</td>
                                        <td colspan="3"></td>
                                        <td class="f-w-600">{{ getAmtCustom($saleReturn->subtotal) }}</td>
                                    </tr>
                                    @if ($saleReturn->other > 0)
                                        <tr>
                                            <td colspan="2" class="text-right f-w-600">@lang('index.other'):</td>
                                            <td colspan="3"></td>
                                            <td class="f-w-600">{{ getAmtCustom($saleReturn->other) }}</td>
                                        </tr>
                                    @endif
                                    @if ($saleReturn->discount > 0)
                                        <tr>
                                            <td colspan="2" class="text-right f-w-600">@lang('index.discount'):</td>
                                            <td colspan="3"></td>
                                            <td class="f-w-600">{{ getAmtCustom($saleReturn->discount) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="2" class="text-right f-w-600">@lang('index.grand_total'):</td>
                                        <td colspan="3"></td>
                                        <td class="f-w-600">{{ getAmtCustom($saleReturn->grand_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right f-w-600">@lang('index.paid'):</td>
                                        <td colspan="3"></td>
                                        <td class="f-w-600">{{ getAmtCustom($saleReturn->paid) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right f-w-600">@lang('index.due'):</td>
                                        <td colspan="3"></td>
                                        <td class="f-w-600">{{ getAmtCustom($saleReturn->due) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($saleReturn->note)
                                <div class="mt-20">
                                    <p><span class="f-w-600">@lang('index.note'):</span> {{ $saleReturn->note }}</p>
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
    <script src="{!! $baseURL . 'frequent_changing/js/sale_return.js' !!}"></script>
@endsection

