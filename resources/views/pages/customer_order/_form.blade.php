@extends('layouts.app')
@push('styles')
<style>
/* FORM CONTAINER */
.tab-content {
    border-radius: 0 0 10px 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

/* TAB HEADER */
.nav-tabs {
    border-bottom: 2px solid #dee2e6;
}

.nav-tabs .nav-link {
    font-size: 14px;
    font-weight: 500;
    padding: 8px 16px;
    color: #495057;
    border-radius: 6px 6px 0 0;
}

.nav-tabs .nav-link.active {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
}

/* LABELS */
.form-group label {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 4px;
    color: #333;
}

/* INPUTS / SELECTS SMALLER */
.form-control,
.select2-container--default .select2-selection--single {
    height: 38px !important;
    min-height: 38px !important;
    padding: 6px 10px !important;
    font-size: 13px !important;
    border-radius: 6px !important;
}

/* SELECT2 FIX */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px !important;
    font-size: 13px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
}

/* INPUT GROUP */
.input-group-text {
    font-size: 12px;
    padding: 6px 10px;
}

/* TABLE */
.table th,
.table td {
    vertical-align: middle;
    padding: 8px;
    font-size: 13px;
    white-space: nowrap;
}

.table thead th {
    background: #f8f9fa;
    font-weight: 600;
}

/* REDUCE TABLE COLUMN WIDTH */
.w-220-p {
    width: 140px !important;
}

.w-50-p {
    width: 50px !important;
}

/* BUTTONS */
.btn {
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 6px;
}

.btn-success,
.btn-primary,
.btn-secondary,
.btn-danger {
    font-weight: 500;
}

/* SECTION TITLE */
h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #212529;
}

/* FORM SPACING */
.form-group {
    margin-bottom: 12px;
}

/* TABLE RESPONSIVE */
.table-responsive {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 10px;
}

/* ACTION BUTTON */
.dlt_button {
    padding: 5px 8px;
    border-radius: 5px;
    background: #f8d7da;
    color: #dc3545;
}

.dlt_button:hover {
    background: #dc3545;
    color: #fff;
}
</style>
@endpush
@section('content')




<div class="container-fluid" style="padding-left:30px";>

    <form method="POST" action="">
        @csrf

        <!-- TAB HEADER -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">

            <li class="nav-item">
                <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basicTab"
                    type="button">
                    Basic Details
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#productTab"
                    type="button">
                    Product Details
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoiceTab"
                    type="button">
                    Invoice / Quotations
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#deliveryTab"
                    type="button">
                    Deliveries
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" id="raw-tab" data-bs-toggle="tab" data-bs-target="#rawTab" type="button">
                    Raw Material
                </button>
            </li>

            <li class="nav-item">
                <button class="nav-link" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notesTab" type="button">
                    Notes & Submit
                </button>
            </li>

        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content border border-top-0 p-4 bg-white">

            <!-- TAB 1 -->
            <div class="tab-pane fade show active" id="basicTab">
                <h4>Basic Details</h4>

                <div class="row">

                    <!-- 1 Order ID / Reference Number -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Order ID / Reference No <span class="required_star">*</span></label>
                            <input type="text" name="reference_no" id="code" class="form-control"
                                value="{{ isset($customerOrder->reference_no) ? $customerOrder->reference_no : $ref_no }}"
                                readonly>
                        </div>
                    </div>

                    <!-- 2 Product Name -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Product Name <span class="required_star">*</span></label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name"
                                value="{{ old('product_name', isset($customerOrder->product_name) ? $customerOrder->product_name : '') }}">
                        </div>
                    </div>

                    <!-- 3 Type -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Type <span class="required_star">*</span></label>
                            <select name="order_type" id="order_type" class="form-control select2">
                                <option value="">Select Type</option>
                                @foreach ($orderTypes as $key => $orderType)
                                <option value="{{ $key }}"
                                    {{ isset($customerOrder->order_type) && $customerOrder->order_type == $key ? 'selected' : '' }}>
                                    {{ $orderType }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 2 Customer Name -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Customer Name <span class="required_star">*</span></label>
                            <select name="customer_id" id="customer_id" class="form-control select2">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $key => $customer)
                                <option value="{{ $key }}"
                                    {{ isset($customerOrder->customer_id) && $customerOrder->customer_id == $key ? 'selected' : '' }}>
                                    {{ $customer }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- 4 Delivery Date -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Delivery Date <span class="required_star">*</span></label>
                            <input type="text" name="delivery_date" class="form-control customDatepicker" readonly
                                value="{{ isset($customerOrder->delivery_date) ? $customerOrder->delivery_date : old('delivery_date') }}">
                        </div>
                    </div>

                    <!-- 5 Order Date -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Order Date <span class="required_star">*</span></label>
                            <input type="text" name="order_date" class="form-control customDatepicker" readonly
                                value="{{ old('order_date', isset($customerOrder->order_date) ? $customerOrder->order_date : date('Y-m-d')) }}">
                        </div>
                    </div>

                    <!-- 7 Purpose -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Purpose <span class="required_star">*</span></label>
                            <select name="purpose" class="form-control select2">
                                <option value="">Select Purpose</option>
                                <option value="commercial"
                                    {{ isset($customerOrder->purpose) && $customerOrder->purpose == 'commercial' ? 'selected' : '' }}>
                                    Commercial
                                </option>
                                <option value="sample"
                                    {{ isset($customerOrder->purpose) && $customerOrder->purpose == 'sample' ? 'selected' : '' }}>
                                    Sample
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- 8 Expected Delivery -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Expected Delivery</label>
                            <input type="text" name="expected_delivery" class="form-control customDatepicker" readonly
                                value="{{ old('expected_delivery', isset($customerOrder->expected_delivery) ? $customerOrder->expected_delivery : '') }}">
                        </div>
                    </div>

                    <!-- 9 Status -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Status <span class="required_star">*</span></label>
                            <select name="status" class="form-control select2">
                                <option value="">Select Status</option>
                                <option value="pending"
                                    {{ isset($customerOrder->status) && $customerOrder->status == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="in_progress"
                                    {{ isset($customerOrder->status) && $customerOrder->status == 'in_progress' ? 'selected' : '' }}>
                                    In Progress</option>
                                <option value="completed"
                                    {{ isset($customerOrder->status) && $customerOrder->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- 10 Region -->
                    <div class="col-md-4 mb-2">
                        <div class="form-group">
                            <label>Region <span class="required_star">*</span></label>
                            <select name="region_id" id="region_id" class="form-control select2">
                                <option value="">Select Region</option>
                                @foreach ($regions as $key => $region)
                                <option value="{{ $key }}"
                                    {{ isset($customerOrder->region_id) && $customerOrder->region_id == $key ? 'selected' : '' }}>
                                    {{ $region }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="button" class="btn btn-primary next-tab" data-next="#productTab">
                        Next
                    </button>
                </div>
            </div>

            <!-- TAB 2 -->
            <div class="tab-pane fade" id="productTab">
                <h4>Product Details</h4>

                <div class="row">

                    <!-- Category -->
                    <div class="col-md-4 mb-3">
                        <label>Product Category</label>
                        <select name="formula_category" id="formula_category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" data-code="{{ $cat->code }}">
                                {{ $cat->name }} ({{ $cat->code }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product -->
                    <div class="col-md-4 mb-3">
                        <label>Product</label>
                        <select name="formula_product" id="formula_product" class="form-control">
                            <option value="">-- Select Category First --</option>
                        </select>
                        {{-- Spinner shown while loading --}}
                        <small id="product_loading" class="text-muted d-none">Loading products...</small>
                    </div>

                    <!-- Formula Code -->
                    <div class="col-md-4 mb-3">
                        <label>Formula Code</label>
                        <input type="text" id="formula_code" name="formula_code" class="form-control" readonly>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="button" class="btn btn-primary" id="openFormulaModal"
                        data-bs-toggle="modal" data-bs-target="#formulaModal" disabled>
                        Formula
                    </button>
                    <small class="text-muted ms-2" id="formula_btn_hint">Select a product to enable</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#basicTab">
                        Previous
                    </button>

                    <button type="button" class="btn btn-primary next-tab" data-next="#invoiceTab">
                        Next
                    </button>
                </div>
            </div>

            <!-- TAB 3 -->
            <div class="tab-pane fade" id="invoiceTab">
                <h4>Invoice / Quotations</h4>

                <!-- ADD INVOICE FIELDS HERE -->

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#productTab">
                        Previous
                    </button>

                    <button type="button" class="btn btn-primary next-tab" data-next="#deliveryTab">
                        Next
                    </button>
                </div>
            </div>

            <!-- TAB 4 -->
            <div class="tab-pane fade" id="deliveryTab">
                <h4>Deliveries</h4>

                <!-- ADD DELIVERY FIELDS HERE -->

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#invoiceTab">
                        Previous
                    </button>

                    <button type="button" class="btn btn-primary next-tab" data-next="#rawTab">
                        Next
                    </button>
                </div>
            </div>

            <!-- TAB 5 -->
            <div class="tab-pane fade" id="rawTab">
                <h4>Raw Material</h4>

                <!-- ADD RAW MATERIAL HERE -->

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#deliveryTab">
                        Previous
                    </button>

                    <button type="button" class="btn btn-primary next-tab" data-next="#notesTab">
                        Next
                    </button>
                </div>
            </div>

            <!-- TAB 6 -->
            <div class="tab-pane fade" id="notesTab">
                <h4>Notes & Submit</h4>

                <!-- ADD NOTES HERE -->

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary prev-tab" data-prev="#rawTab">
                        Previous
                    </button>

                    <div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('customer-orders.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>


<!-- FORMULA MODAL -->
<div class="modal fade" id="formulaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Formula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Formula Code: <strong id="show_formula_code"></strong></p>

                <div id="formula_loading_msg" class="text-muted mb-2 d-none">
                    <small>Loading formula details...</small>
                </div>

                <textarea name="formula_description" id="formula_description" class="form-control" rows="10"
                    placeholder="Select a product first to load its formula"></textarea>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" type="button" id="saveFormulaBtn">
                    Save Formula
                </button>
            </div>

        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
$(document).ready(function () {


    $('.next-tab').click(function () {
        let nextTab = $(this).data('next');
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $('button[data-bs-target="' + nextTab + '"]').addClass('active');
        $(nextTab).addClass('show active');
    });

    $('.prev-tab').click(function () {
        let prevTab = $(this).data('prev');
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $('button[data-bs-target="' + prevTab + '"]').addClass('active');
        $(prevTab).addClass('show active');
    });



</script>
@endpush