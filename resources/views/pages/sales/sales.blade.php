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
<section class="main-content-wrapper">
    @include('utilities.messages')
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="top-left-header">{{ isset($title) && $title ? $title : '' }}</h2>
                <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                    data-id_name="datatable">
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </section>


    <div class="box-wrapper">

        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="width_1_p">@lang('index.sn')</th>
                            <th class="width_10_p">@lang('index.reference_no')</th>
                            <th class="width_10_p">@lang('index.customer')</th>
                            <th class="width_10_p">@lang('index.status')</th>
                            <th class="width_10_p">@lang('index.paid_amount')</th>
                            <th class="width_10_p">@lang('index.due_amount')</th>
                            <th class="width_10_p">@lang('index.discount')</th>
                            <th class="width_10_p">@lang('index.g_total')</th>
                            <th class="width_10_p">@lang('index.date')</th>
                            <th class="width_3_p">@lang('index.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($obj && !empty($obj))
                        <?php
                                $i = count($obj);
                                ?>
                        @endif
                        @foreach ($obj as $value)
                        <tr>
                            <td class="c_center">{{ $i-- }}</td>
                            <td>{{ $value->reference_no }}</td>
                            <td>{{ getCustomerNameById($value->customer_id) }}</td>
                            <td>{{ $value->status }}</td>
                              @php
    $currSymbol = '₹'; // default
    if ($value->currency_id && isset($currencies[$value->currency_id])) {
        $currSymbol = $currencies[$value->currency_id]->symbol;
    }
@endphp
<td>{{ $currSymbol }} {{ number_format($value->paid, 2) }}</td>
<td>{{ $currSymbol }} {{ number_format($value->due, 2) }}</td>
<td>{{ $currSymbol }} {{ number_format($value->discount, 2) }}</td>
<td>{{ $currSymbol }} {{ number_format($value->grand_total, 2) }}</td>
                            <td>
                                @if ($value->status != 'Final')
                                @if (routePermission('sale.edit'))
                                <a href="{{ url('sales') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}/edit"
                                    class="button-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.edit')"><i class="fa fa-edit"></i></a>
                                @endif
                                @endif
                                @if (routePermission('sale.view-details'))
                                <a href="{{ url('sales') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}"
                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.view_details')"><i class="fa fa-eye"></i></a>
                                @endif
                                @if (routePermission('sale.chalan-print'))
                                <a href="javascript:void()" class="button-info print_challan" data-id="{{ $value->id }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.print_challan')"><i class="fa fa-print"></i></a>
                                @endif
                                @if (routePermission('sale.chalan-download'))
                                <a href="{{ route('sales.download_challan', encrypt_decrypt($value->id, 'encrypt')) }}"
                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.download_challan')"><i class="fa fa-download"></i></a>
                                @endif
                                <!-- @if (routePermission('sale.download-invoice'))
                                            <a href="{{ route('sales.download_invoice', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="@lang('index.download_invoice')"><i class="fa fa-download"></i></a>
                                        @endif -->

                                @if (routePermission('sale.download-invoice'))
                                <a href="javascript:void(0)" class="button-info openInvoiceModal"
                                    data-id="{{ encrypt_decrypt($value->id, 'encrypt') }}" data-bs-toggle="tooltip"
                                    title="@lang('index.download_invoice')">
                                    <i class="fa fa-download"></i>
                                </a>
                                @endif
                                @if (routePermission('quotation.create'))
                                <a href="javascript:void(0)" class="button-info convert-to-quotation"
                                    data-id="{{ encrypt_decrypt($value->id, 'encrypt') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="@lang('index.convert_to_quotation')">
                                    <i class="fa fa-exchange"></i>
                                </a>
                                @endif
                                @if (routePermission('sale.delete'))
                                <a href="#" class="delete button-danger" data-form_class="alertDelete{{ $value->id }}"
                                    type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.delete')">
                                    <form action="{{ route('sales.destroy', $value->id) }}"
                                        class="alertDelete{{ $value->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <i class="c_padding_13 fa fa-trash tiny-icon"></i>
                                    </form>
                                </a>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

    </div>







</section>



<div class="modal fade" id="invoiceDownloadModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Select Invoice Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <select id="invoice_type" class="form-control">
                    <option value="inr">INR Invoice</option>
                    <option value="converted">Selected Currency Invoice</option>
                    <option value="both">Download Both</option>
                </select>
            </div>

            <div class="modal-footer">
                <button class="btn bg-blue-btn" id="downloadInvoiceBtn">
                    Download
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{!! $baseURL . 'assets/datatable_custom/jquery-3.3.1.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/jquery.dataTables.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/dataTables.bootstrap4.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/dataTables.buttons.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/buttons.html5.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/buttons.print.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/jszip.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/pdfmake.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/vfs_fonts.js' !!}"></script>
<script src="{!! $baseURL . 'frequent_changing/newDesign/js/forTable.js' !!}"></script>
<script src="{!! $baseURL . 'frequent_changing/js/custom_report.js' !!}"></script>
<script src="{!! $baseURL . 'frequent_changing/js/sales.js' !!}"></script>
<script>
$(document).ready(function() {

    let hidden_alert = $("#hidden_alert").val();
    let hidden_cancel = $("#hidden_cancel").val();
    let hidden_ok = $("#hidden_ok").val();

    let confirm_convert = "{{ __('index.confirm_convert_to_quotation') }}";

    // =========================
    // Convert to quotation
    // =========================
    $(document).on('click', '.convert-to-quotation', function(e) {
        e.preventDefault();

        let salesId = $(this).data('id');

        swal({
            title: hidden_alert + "!",
            text: confirm_convert,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: hidden_ok,
            cancelButtonText: hidden_cancel,
            confirmButtonColor: "#3c8dbc",
        }, function(isConfirm) {
            if (isConfirm) {

                let form = $('<form>', {
                    method: 'POST',
                    action: '{{ url("quotation/convert-from-sales") }}/' + salesId
                });

                form.append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: '{{ csrf_token() }}'
                }));

                $('body').append(form);
                form.submit();
            }
        });
    });

});


// =========================
// Invoice Modal Logic
// =========================
let selectedSaleId = null;

// Open modal
document.querySelectorAll('.openInvoiceModal').forEach(btn => {
    btn.addEventListener('click', function () {
        selectedSaleId = this.dataset.id;

        let modal = new bootstrap.Modal(document.getElementById('invoiceDownloadModal'));
        modal.show();
    });
});


// =========================
// Download Invoice
// =========================
document.getElementById('downloadInvoiceBtn').addEventListener('click', function () {

    let type = document.getElementById('invoice_type').value;

    if (!selectedSaleId) return;

    // ✅ Correct Laravel route usage
    let baseUrl = "{{ route('sales.download_invoice', ':id') }}";
    baseUrl = baseUrl.replace(':id', selectedSaleId);

    if (type === 'both') {
        window.open(baseUrl + '?type=inr', '_blank');
        window.open(baseUrl + '?type=converted', '_blank');
    } else {
        window.open(baseUrl + '?type=' + type, '_blank');
    }

});
</script>
@endsection