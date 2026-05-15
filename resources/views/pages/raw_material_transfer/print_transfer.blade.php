<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $transfer->transfer_reference_no }}</title>
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
        <table class="w-100 mt-20">
            <thead class="b-r-3 bg-color-000000">
                <tr>
                    <th class="w-5 text-start">@lang('index.sn')</th>
                    <th class="w-30 text-start">@lang('index.raw_material')</th>
                    <th class="w-15 text-center">@lang('index.unit')</th>
                    <th class="w-15 text-center">@lang('index.quantity')</th>
                    <th class="w-15 text-center">@lang('index.unit_price')</th>
                    <th class="w-20 text-right pr-5">@lang('index.total')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transferDetails as $key => $detail)
                    <?php $rm = $detail->rawMaterial; ?>
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $rm ? $rm->name : '' }}</td>
                        <td class="text-center">{{ $rm && $rm->unit ? getRMUnitById($rm->unit) : '' }}</td>
                        <td class="text-center">{{ $detail->quantity }}</td>
                        <td class="text-center">{{ $detail->unit_price }} {{ $setting->currency }}</td>
                        <td class="text-right pr-10">{{ $detail->total_amount }} {{ $setting->currency }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right f-w-600 pr-10">@lang('index.grand_total'):</td>
                    <td class="f-w-600 text-right pr-10">{{ $transferDetails->sum('total_amount') }} {{ $setting->currency }}</td>
                </tr>
            </tfoot>
        </table>
        @if ($transfer->note)
            <div class="mt-20">
                <p><span class="f-w-600">@lang('index.note'):</span> {{ $transfer->note }}</p>
            </div>
        @endif
        <div class="mt-30 text-center">
            <p class="f-w-600">@lang('index.authorized_signature')</p>
        </div>
    </div>
</body>

</html>

