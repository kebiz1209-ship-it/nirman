<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $saleReturn->reference_no }}</title>
    <link rel="stylesheet" href="{{ getBaseURL() }}frequent_changing/css/pdf_common.css">
</head>

<body>
    <?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
    ?>
    <div class="m-auto b-r-5 p-30">
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
                        {{ $saleReturn->sale_ref_no }}
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
        <table class="w-100 mt-20">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start">@lang('index.sn')</th>
                    <th class="w-30 text-start">@lang('index.product')(@lang('index.code'))</th>
                    <th class="w-15 text-center">@lang('index.unit')</th>
                    <th class="w-15 text-center">@lang('index.return_quantity')</th>
                    <th class="w-15 text-center">@lang('index.unit_price')</th>
                    <th class="w-20 text-right pr-5">@lang('index.total')</th>
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
                        <td class="text-start">
                            {{ $productInfo->name }}({{ $productInfo->code }})
                            @if ($manufactureInfo && $manufactureInfo->expiry_days !== null && $manufactureInfo->complete_date !== null && $manufactureInfo->expiry_days !== 0)
                                <br><small>Expiry Date: {{ getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days)) }}</small>
                            @endif
                            @if ($manufactureInfo && $manufactureInfo->batch_no !== null && $manufactureInfo->batch_no !== '')
                                <br><small>Batch Number: {{ $manufactureInfo->batch_no }}</small>
                            @endif
                        </td>
                        <td class="text-center">{{ getRMUnitById($productInfo->unit) }}</td>
                        <td class="text-center">{{ $detail->product_quantity }}</td>
                        <td class="text-center">{{ getAmtCustom($detail->unit_price) }}</td>
                        <td class="text-right pr-10">{{ getAmtCustom($detail->total_amount) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <tr>
                <td valign="top" class="w-50">
                    <div class="pt-20">
                        <h4 class="d-block pb-10">@lang('index.note')</h4>
                        <div class="">
                            <p class="h-180 color-black">
                                {{ $saleReturn->note }}
                            </p>
                        </div>
                    </div>
                </td>
                <td class="w-50">
                    <table>
                        <tr>
                            <td class="w-50 pr-0">
                                <p class="">@lang('index.subtotal')</p>
                            </td>
                            <td class="w-50 pr-0 text-right">
                                <p>{{ getAmtCustom($saleReturn->subtotal) }} </p>
                            </td>
                        </tr>
                    </table>
                    @if ($saleReturn->other > 0)
                        <table>
                            <tr>
                                <td class="w-50 pr-0">
                                    <p class="">@lang('index.other')</p>
                                </td>
                                <td class="w-50 pr-0 text-right">
                                    <p>{{ getAmtCustom($saleReturn->other) }} </p>
                                </td>
                            </tr>
                        </table>
                    @endif

                    @if ($saleReturn->discount > 0)
                        <table>
                            <tr>
                                <td class="w-50">
                                    <p class="">@lang('index.discount')</p>
                                </td>
                                <td class="w-50 pr-0 text-right">
                                    <p>{{ getAmtCustom($saleReturn->discount) }} </p>
                                </td>
                            </tr>
                        </table>
                    @endif

                    <table class="mt-10 mb-10">
                        <tr>
                            <td class="w-50 pr-0 border-top-dotted-gray border-bottom-dotted-gray">
                                <p class="">@lang('index.grand_total') :</p>
                            </td>
                            <td class="w-50 pr-0 text-right">
                                <p>{{ getAmtCustom($saleReturn->grand_total) }} </p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="w-50 pr-0">
                                <p class="">@lang('index.paid')</p>
                            </td>
                            <td class="w-50 pr-0 text-right">
                                <p>{{ getAmtCustom($saleReturn->paid) }} </p>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="w-50 pr-0">
                                <p class="">@lang('index.due')</p>
                            </td>
                            <td class="w-50 pr-0 text-right">
                                <p>{{ getAmtCustom($saleReturn->due) }} </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


        <table class="mt-50">
            <tr>
                <td class="w-50">
                </td>
                <td class="w-50 text-right">
                    <p class="rgb-71 d-inline border-top-e4e5ea pt-10">@lang('index.authorized_signature')</p>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>

