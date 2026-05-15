<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $purchaseReturn->reference_no }}</title>
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
        <table class="w-100 mt-20">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start">@lang('index.sn')</th>
                    <th class="w-30 text-start">@lang('index.item')</th>
                    <th class="w-15 text-center">@lang('index.unit')</th>
                    <th class="w-15 text-center">@lang('index.return_qty')</th>
                    <th class="w-15 text-center">@lang('index.unit_price')</th>
                    <th class="w-20 text-right pr-5">@lang('index.total')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returnDetails as $key => $detail)
                    <?php $rm = \App\RawMaterial::find($detail->item_id); ?>
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $rm ? $rm->name : '' }}</td>
                        <td class="text-center">{{ $rm ? getRMUnitById($rm->unit) : '' }}</td>
                        <td class="text-center">{{ $detail->return_quantity_amount }}</td>
                        <td class="text-center">{{ $detail->unit_price }} {{ $setting->currency }}</td>
                        <td class="text-right pr-10">{{ $detail->total }} {{ $setting->currency }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right f-w-600 pr-10">@lang('index.total_return_amount'):</td>
                    <td class="f-w-600 text-right pr-10">{{ $purchaseReturn->total_return_amount }} {{ $setting->currency }}</td>
                </tr>
            </tfoot>
        </table>
        @if ($purchaseReturn->note)
            <div class="mt-20">
                <p><span class="f-w-600">@lang('index.note'):</span> {{ $purchaseReturn->note }}</p>
            </div>
        @endif
    </div>
</body>

</html>

