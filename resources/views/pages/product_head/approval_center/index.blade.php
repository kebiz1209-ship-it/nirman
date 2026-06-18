@extends('pages.product_head.layout.app')

@section('content')


<style>
.approval-index {
    font-size: 12px;
}

.approval-index h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.approval-index .card-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.approval-index .form-control {
    height: 32px;
    font-size: 12px;
}

.approval-index .btn {
    font-size: 12px;
}

.approval-index label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 4px;
}

.approval-index .card {
    border-radius: 6px;
    border: 1px solid #dee2e6;
}

.approval-index .card-header {
    padding: 12px 15px;
    background: #f8f9fa !important;
}

.approval-index table th {
    white-space: nowrap;
    font-size: 12px;
    background: #f8f9fa;
    vertical-align: middle;
}

.approval-index table td {
    font-size: 12px;
    vertical-align: middle;
}

.approval-index .badge {
    font-size: 11px;
    padding: 5px 8px;
}

.approval-index .btn-sm {
    font-size: 11px;
    padding: 4px 8px;
}

.approval-index .dropdown-menu {
    font-size: 12px;
}

.approval-index .table-responsive {
    overflow-x: auto;
}

/* KPI Cards */

.approval-index .summary-card {
    border-radius: 6px;
    transition: all .2s;
}

.approval-index .summary-card h6 {
    font-size: 12px;
    margin-bottom: 6px;
}

.approval-index .summary-card h3 {
    font-size: 22px;
    font-weight: 700;
}

.approval-index .border-left-warning {
    border-left: 4px solid #ffc107 !important;
}

.approval-index .border-left-success {
    border-left: 4px solid #28a745 !important;
}

.approval-index .border-left-danger {
    border-left: 4px solid #dc3545 !important;
}

.approval-index .border-left-primary {
    border-left: 4px solid #007bff !important;
}
</style>

<div class="container-fluid approval-index" style="margin-left:30px;">
<!-- PAGE HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="font-weight-bold mb-1">
            Approval Management Center
        </h3>

        <small class="text-muted">
            Manage and track all approval workflows across departments
        </small>

    </div>

    <div>

        <a href="#"
           class="btn btn-primary">

            <i class="fa fa-plus"></i>
            New Approval Request

        </a>

    </div>

</div>



<!-- SUMMARY CARDS -->

<div class="row mb-4">

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card summary-card border-left-warning">

            <div class="card-body">

                <h6 class="text-muted">
                    Pending Approvals
                </h6>

                <h3 class="font-weight-bold mb-0">
                    42
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card summary-card border-left-success">

            <div class="card-body">

                <h6 class="text-muted">
                    Approved
                </h6>

                <h3 class="font-weight-bold mb-0">
                    185
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card summary-card border-left-danger">

            <div class="card-body">

                <h6 class="text-muted">
                    Rejected
                </h6>

                <h3 class="font-weight-bold mb-0">
                    16
                </h3>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card summary-card border-left-primary">

            <div class="card-body">

                <h6 class="text-muted">
                    On Hold
                </h6>

                <h3 class="font-weight-bold mb-0">
                    9
                </h3>

            </div>

        </div>

    </div>

</div>

<!-- FILTER SECTION -->

<div class="card mb-3">

    <div class="card-header bg-white">
        <h5 class="mb-0">
            Search Approval Requests
        </h5>
    </div>

    <div class="card-body">

        <div class="row align-items-end">

            <div class="col">
                <label>Approval Type</label>

                <select class="form-control">
                    <option>All Types</option>
                    <option>Order Approval</option>
                    <option>Product Approval</option>
                    <option>Formula Approval</option>
                    <option>Production Approval</option>
                    <option>QC Approval</option>
                    <option>Logistics Approval</option>
                </select>
            </div>

            <div class="col">
                <label>Status</label>

                <select class="form-control">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                    <option>Hold</option>
                </select>
            </div>

            <div class="col">
                <label>Priority</label>

                <select class="form-control">
                    <option>All Priority</option>
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                    <option>Critical</option>
                </select>
            </div>

            <div class="col">
                <label>Date Range</label>

                <input type="date"
                       class="form-control">
            </div>

            <div class="col">
                <label>Requested By</label>

                <input type="text"
                       class="form-control"
                       placeholder="Role/User">
            </div>

            <div class="col-auto">

                <button class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    Search
                </button>

                <button class="btn btn-secondary">
                    <i class="fa fa-refresh"></i>
                    Reset
                </button>

            </div>

        </div>

    </div>

</div>



<!-- APPROVAL TABLE -->

<div class="card">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Approval Requests
        </h5>

        <span class="badge badge-info p-2">
            Total Records : 252
        </span>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="thead-light">

                    <tr>
                        <th>SN</th>
                        <th>Approval ID</th>
                        <th>Type</th>
                        <th>Reference No</th>
                        <th>Requested By</th>
                        <th>Requested To</th>
                        <th>Department</th>
                        <th>Priority</th>
                        <th>Current Status</th>
                        <th>Last Action</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>

                        <td>
                            <strong>APR-000145</strong>
                        </td>

                        <td>
                            Order Approval
                        </td>

                        <td>
                            SO-2584
                        </td>

                        <td>
                            Sales Executive
                        </td>

                        <td>
                            Sales Manager
                        </td>

                        <td>
                            Sales
                        </td>

                        <td>
                            <span class="badge badge-warning">
                                Medium
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-primary">
                                Pending
                            </span>
                        </td>

                        <td>
                            Submitted
                        </td>

                        <td>
                            18-Jun-2026 10:30 AM
                        </td>

                        <td>

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm"
                                        data-toggle="dropdown">

                                    <i class="fa fa-ellipsis-v"></i>

                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#">
                                        View Details
                                    </a>

                                    <a class="dropdown-item text-success" href="#">
                                        Approve
                                    </a>

                                    <a class="dropdown-item text-warning" href="#">
                                        Hold
                                    </a>

                                    <a class="dropdown-item text-danger" href="#">
                                        Reject
                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>

                        <td>
                            <strong>APR-000146</strong>
                        </td>

                        <td>
                            Formula Approval
                        </td>

                        <td>
                            FRM-0015
                        </td>

                        <td>
                            R&D Executive
                        </td>

                        <td>
                            QA Head
                        </td>

                        <td>
                            R&D
                        </td>

                        <td>
                            <span class="badge badge-danger">
                                Critical
                            </span>
                        </td>

                        <td>
                            <span class="badge badge-success">
                                Approved
                            </span>
                        </td>

                        <td>
                            Approved by QA Head
                        </td>

                        <td>
                            17-Jun-2026 04:45 PM
                        </td>

                        <td>

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm"
                                        data-toggle="dropdown">

                                    <i class="fa fa-ellipsis-v"></i>

                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="#">
                                        View Details
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        Approval History
                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@endsection
