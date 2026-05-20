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
            <div class="col-md-offset-4 col-md-2">

            </div>
        </div>
    </section>


<style>
.dispatch-tabs {
    margin-bottom: 15px;
    gap: 10px;
}

.dispatch-tabs .btn {
    border-radius: 30px;
    padding: 7px 18px;
    font-size: 13px;
    font-weight: 600;
    transition: 0.3s;
}

.active-tab {
    background: #0d6efd !important;
    color: #fff !important;
    border-color: #0d6efd !important;
}
</style>
<div class="mb-3 d-flex flex-wrap gap-2 dispatch-tabs">

    <button type="button" class="btn btn-sm btn-primary filter-status active-tab" data-status="">
    All
</button>

    <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="Not Dispatched">
        Not Dispatched
    </button>

     <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="In Progress">
        In Progress
    </button>

     <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="Partially Dispatched">
        Partially Dispatched
    </button>

     <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="Dispatched">
        Dispatched
    </button>

     <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="Delayed">
        Delayed
    </button>

     <button class="btn btn-sm btn-outline-secondary filter-status"
        data-status="On Hold">
        On Hold
    </button>

</div>

    <div class="box-wrapper">

        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job Card No</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th>Region/Country</th>
                            <th>Order Type</th>
                            <th>Business Type</th>
                            <th>Purpose</th>
                            <th>Product / Service</th>
                            <th>Handler</th>
                            <th>Sales Person</th>
                            <th>Qty</th>
                            <th>Total Value</th>
                            <th>Cost</th>
                            <th>Profit</th>
                            <th>Dispatch Status</th>
                            <th>Expected Dispatch</th>
                            <th>Actual Dispatch</th>
                            <th>Delay Days</th>
                            <th>Delivery Date</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($obj && !empty($obj))
                        <?php $i = count($obj); ?>
                        @endif

                        @foreach ($obj as $value)
                        <tr>

                            {{-- Job Card --}}
                            <td>{{ $value->reference_no }}</td>

                            {{-- Order Date --}}
                            <td>
                                {{ $value->order_date ? getDateFormat($value->order_date) : '' }}
                            </td>

                            {{-- Customer --}}
                            <td>{{ $value->customer->name ?? '' }}</td>

                            {{-- Region --}}
                            <td>{{ $value->region_country }}</td>

                            {{-- Order Type --}}
                            <td>
                                {{ $value->order_type }}
                            </td>

                            {{-- Business Type --}}
                            <td>
                                {{ $value->business_type }}
                            </td>

                            {{-- Purpose --}}
                            <td>{{ $value->purpose }}</td>

                            {{-- Product / Service --}}
                            <td>{{ $value->product_service }}</td>

                            {{-- Handler --}}
                            <td>
                                {{ getUserName($value->handler_id) }}
                            </td>

                            {{-- Sales Person --}}
                            <td>
                                {{ getUserName($value->sales_person_id) }}
                            </td>

                            {{-- Quantity --}}
                            <td>{{ $value->quantity }}</td>

                            {{-- Total Amount --}}
                            <td>{{ getAmtCustom($value->total_amount) }}</td>

                            {{-- Cost --}}
                            <td>{{ getAmtCustom($value->total_cost) }}</td>

                            {{-- Profit --}}
                            <td>{{ getAmtCustom($value->total_profit) }}</td>

                            {{-- Dispatch Status --}}
                            <td>{{ $value->dispatch_status }}</td>

                            {{-- Expected Dispatch --}}
                            <td>
                                {{ $value->expected_dispatch_date ? getDateFormat($value->expected_dispatch_date) : '' }}
                            </td>

                            {{-- Actual Dispatch --}}
                            <td>
                                {{ $value->actual_dispatch_date ? getDateFormat($value->actual_dispatch_date) : '' }}
                            </td>

                            {{-- Delay Days --}}
                            <td>{{ $value->delay_days }}</td>

                            {{-- Delivery Date --}}
                            <td>
                                {{ $value->delivery_date ? getDateFormat($value->delivery_date) : '' }}
                            </td>

                            {{-- Created By --}}
                            <td>{{ getUserName($value->created_by) }}</td>

                            {{-- Actions --}}
                            <td>

                                @if (routePermission('order.view-details'))
                                <a href="{{ url('customer-orders') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}"
                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.view_details')">

                                    <i class="fa fa-eye tiny-icon"></i>
                                </a>
                                @endif

                                @if (routePermission('order.edit'))
                                <a href="{{ url('customer-orders') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}/edit"
                                    class="button-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.edit')">

                                    <i class="fa fa-edit tiny-icon"></i>
                                </a>
                                @endif

                                @if (routePermission('order.print-invoice'))
                                <a href="javascript:void()" class="button-info print_invoice" data-id="{{ $value->id }}"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.print_invoice')">

                                    <i class="fa fa-print tiny-icon"></i>
                                </a>
                                @endif

                                @if (routePermission('order.download-invoice'))
                                <a href="{{ route('customer-order-download', encrypt_decrypt($value->id, 'encrypt')) }}"
                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.download_invoice')">

                                    <i class="fa fa-download tiny-icon"></i>
                                </a>
                                @endif

                                @if (routePermission('order.delete'))
                                <a href="#" class="delete button-danger" data-form_class="alertDelete{{ $value->id }}"
                                    type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.delete')">

                                    <form action="{{ route('customer-orders.destroy', $value->id) }}"
                                        class="alertDelete{{ $value->id }}" method="post">

                                        @csrf
                                        @method('DELETE')

                                        <i class="fa fa-trash tiny-icon"></i>

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
@endsection
@section('script')

<!-- <script src="{!! $baseURL . 'assets/datatable_custom/jquery-3.3.1.js' !!}"></script> -->
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
<script src="{!! $baseURL . 'frequent_changing/js/order.js' !!}"></script>

<script>
jQuery(document).ready(function () {

    // get existing DataTable instance
    var table = jQuery('#datatable').DataTable();

    jQuery(document).on('click', '.filter-status', function (e) {
        e.preventDefault();

        // remove active class from all
        jQuery('.filter-status')
            .removeClass('active-tab btn-primary btn-info btn-warning btn-success btn-danger btn-dark')
            .addClass('btn-outline-secondary');

        // activate current button
        jQuery(this).removeClass('btn-outline-secondary').addClass('active-tab');

        let status = jQuery(this).data('status');

        // Dispatch Status column (15th column = index 14)
        table.column(14).search(status).draw();
    });

});
</script>

@endsection