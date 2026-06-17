@extends('pages.product_head.layout.app')


@section('content')

<style>
    .order-table {
        font-size: 12px;
    }

    .order-table .card-header h4 {
        font-size: 18px;
        margin-bottom: 0;
    }

    .order-table .form-control {
        height: 32px;
        font-size: 12px;
        padding: 4px 8px;
    }

    .order-table .btn {
        font-size: 12px;
        padding: 4px 10px;
    }

    .order-table table th {
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        background: #f8f9fa;
    }

    .order-table table td {
        font-size: 12px;
        white-space: nowrap;
        vertical-align: middle;
    }

    .order-table .badge {
        font-size: 11px;
        padding: 5px 8px;
    }
</style>

<div class="container-fluid order-table" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Order Management</h4>

            <a href="{{ route('pages.product-head.orders.create') }}"
               class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Order
            </a>
        </div>

        <div class="card-body">

            <!-- Filters -->
            <div class="row mb-3">

                <div class="col-md-2">
                    <label>Date From</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>Date To</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>Customer</label>
                    <select class="form-control">
                        <option>All Customers</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Product Type</label>
                    <select class="form-control">
                        <option>All Products</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Status</label>
                    <select class="form-control">
                        <option>All Status</option>
                        <option>New</option>
                        <option>Under Review</option>
                        <option>Query Raised</option>
                        <option>Waiting for Sales Reply</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                        <option>Sent to Production</option>
                        <option>Hold</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Priority</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Urgent</option>
                    </select>
                </div>

            </div>

            <div class="mb-3">
                <button class="btn btn-info">
                    Search
                </button>

                <button class="btn btn-secondary">
                    Reset
                </button>
            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Assigned Sales</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>ORD-1001</td>
                            <td>17-06-2026</td>
                            <td>ABC Pharma</td>
                            <td>Vitamin Tablets</td>
                            <td>5000</td>
                            <td>
                                <span class="badge badge-danger">
                                    High
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-warning">
                                    Under Review
                                </span>
                            </td>
                            <td>Rahul Sharma</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    View
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>ORD-1002</td>
                            <td>17-06-2026</td>
                            <td>XYZ Healthcare</td>
                            <td>Protein Powder</td>
                            <td>2500</td>
                            <td>
                                <span class="badge badge-success">
                                    Medium
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-primary">
                                    Approved
                                </span>
                            </td>
                            <td>Amit Verma</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    View
                                </a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection