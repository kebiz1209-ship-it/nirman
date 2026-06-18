@extends('pages.product_head.layout.app')

@section('content')


<style>
.communication-index {
    font-size: 12px;
}

.communication-index .card-header h4,
.communication-index .communication-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.communication-index .form-control {
    height: 32px;
    font-size: 12px;
}

.communication-index .btn {
    font-size: 12px;
}

.communication-index table th {
    white-space: nowrap;
    font-size: 12px;
    background: #f8f9fa;
    vertical-align: middle;
}

.communication-index table td {
    vertical-align: middle;
    font-size: 12px;
}

.communication-index .badge {
    font-size: 11px;
    padding: 5px 8px;
}

/* Cards */
.communication-index .card {
    border-radius: 6px;
    border: 1px solid #dee2e6;
}

.communication-index .communication-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 12px 15px;
}

/* Thread Link */
.communication-index .thread-link {
    font-weight: 600;
    text-decoration: none;
}

.communication-index .thread-link:hover {
    text-decoration: underline;
}

/* Unread Count */
.communication-index .unread-count {
    display: inline-block;
    min-width: 18px;
    height: 18px;
    line-height: 18px;
    text-align: center;
    border-radius: 50%;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    margin-left: 4px;
}

/* Type Badge */
.communication-index .type-badge,
.communication-index .priority-badge,
.communication-index .status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
    display: inline-block;
}

/* Type Colors */
.communication-index .type-order {
    background: #e3f2fd;
    color: #0d6efd;
}

.communication-index .type-product {
    background: #e8f5e9;
    color: #198754;
}

.communication-index .type-formula {
    background: #fff3cd;
    color: #856404;
}

.communication-index .type-qc {
    background: #f8d7da;
    color: #dc3545;
}

/* Priority */
.communication-index .priority-low {
    background: #d4edda;
    color: #155724;
}

.communication-index .priority-medium {
    background: #fff3cd;
    color: #856404;
}

.communication-index .priority-high {
    background: #ffe5b4;
    color: #fd7e14;
}

.communication-index .priority-critical {
    background: #f8d7da;
    color: #dc3545;
}

/* Status */
.communication-index .status-open {
    background: #d1ecf1;
    color: #0c5460;
}

.communication-index .status-waiting {
    background: #fff3cd;
    color: #856404;
}

.communication-index .status-resolved {
    background: #d4edda;
    color: #155724;
}

/* Message Preview */
.communication-index .message-preview {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Dropdown */
.communication-index .dropdown-menu {
    font-size: 12px;
}

/* Responsive Table */
.communication-index .table-responsive {
    overflow-x: auto;
}
</style>

<div class="container-fluid communication-index" style="margin-left:20px;">

    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1 font-weight-bold">
                Communication Center
            </h3>

            <small class="text-muted">
                Internal & External Communication Management
            </small>
        </div>

        <div>

            <a href="#" class="btn btn-primary">

                <i class="fa fa-plus"></i>
                New Communication

            </a>

        </div>

    </div>


    <!-- FILTER CARD -->
    <div class="card communication-card mb-4">

        <div class="communication-header">
            <h5 class="mb-0">
                Search Communication Threads
            </h5>
        </div>

        <div class="card-body">

            <div class="row align-items-end">

                <div class="col">
                    <label>Order No</label>
                    <input type="text" class="form-control" placeholder="Order No">
                </div>

                <div class="col">
                    <label>Product</label>
                    <input type="text" class="form-control" placeholder="Product">
                </div>

                <div class="col">
                    <label>Customer</label>
                    <select class="form-control">
                        <option>All Customers</option>
                    </select>
                </div>

                <div class="col">
                    <label>Department</label>
                    <select class="form-control">
                        <option>All Departments</option>
                        <option>Sales</option>
                        <option>Production</option>
                        <option>QC</option>
                        <option>R&D</option>
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
                    <label>Status</label>
                    <select class="form-control">
                        <option>All Status</option>
                        <option>Open</option>
                        <option>Waiting Reply</option>
                        <option>Resolved</option>
                    </select>
                </div>

                <div class="col">
                    <label>Type</label>
                    <select class="form-control">
                        <option>All Types</option>
                        <option>Order Query</option>
                        <option>Product Query</option>
                        <option>Formula Query</option>
                        <option>QC Issue</option>
                    </select>
                </div>

                <div class="col">
                    <label>Date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-auto">

                    <button class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>

                    <button class="btn btn-secondary">
                        <i class="fa fa-refresh"></i>
                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- KPI CARDS -->

    <!-- <div class="row mb-4">

        <div class="col-md-3 mb-3">

            <div class="kpi-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <div class="kpi-title">
                            Open Threads
                        </div>

                        <div class="kpi-value">
                            48
                        </div>
                    </div>

                    <div class="kpi-icon bg-primary">
                        <i class="fa fa-comments"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="kpi-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <div class="kpi-title">
                            Waiting Reply
                        </div>

                        <div class="kpi-value">
                            17
                        </div>
                    </div>

                    <div class="kpi-icon bg-warning">
                        <i class="fa fa-clock"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="kpi-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <div class="kpi-title">
                            Resolved
                        </div>

                        <div class="kpi-value">
                            126
                        </div>
                    </div>

                    <div class="kpi-icon bg-success">
                        <i class="fa fa-check"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="kpi-card">

                <div class="d-flex justify-content-between">

                    <div>
                        <div class="kpi-title">
                            Critical Issues
                        </div>

                        <div class="kpi-value">
                            5
                        </div>
                    </div>

                    <div class="kpi-icon bg-danger">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>

                </div>

            </div>

        </div>

    </div> -->


    <!-- THREAD TABLE -->

    <div class="card communication-card">

        <div class="communication-header d-flex justify-content-between">

            <h5>
                Communication Threads
            </h5>

            <span class="badge badge-light p-2">
                Total Records : 152
            </span>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered communication-table">

                    <thead>

                        <tr>

                            <th>SN</th>
                            <th>Thread ID</th>
                            <th>Type</th>
                            <th>Related To</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Last Message</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Updated At</th>
                            <th width="80">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>
                                <a href="#" class="thread-link">
                                    THR-000145
                                </a>

                                <span class="unread-count">
                                    3
                                </span>
                            </td>

                            <td>
                                <span class="type-badge type-order">
                                    Order Query
                                </span>
                            </td>

                            <td>SO-2458</td>

                            <td>Sales Team</td>

                            <td>Production</td>

                            <td class="message-preview">
                                Dispatch schedule required urgently...
                            </td>

                            <td>
                                <span class="priority-badge priority-medium">
                                    Medium
                                </span>
                            </td>

                            <td>
                                <span class="status-badge status-open">
                                    Open
                                </span>
                            </td>

                            <td>
                                18-Jun-2026 10:15 AM
                            </td>

                            <td>

                                <div class="dropdown">

                                    <button class="btn btn-light btn-sm" data-toggle="dropdown">

                                        <i class="fa fa-ellipsis-v"></i>

                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="#">
                                            View Thread
                                        </a>

                                        <a class="dropdown-item" href="#">
                                            Reply
                                        </a>

                                        <a class="dropdown-item" href="#">
                                            Resolve
                                        </a>

                                        <a class="dropdown-item text-danger" href="#">
                                            Close
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