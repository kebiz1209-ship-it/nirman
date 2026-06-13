@extends('pages.sale-person.layout.app')

@section('content')

<style>
.enquiry-card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.enquiry-card .card-header {
    background: #fff;
    border-bottom: 1px solid #e9ecef;
}

.enquiry-table th {
    font-size: 13px;
    font-weight: 600;
    background: #f8f9fa;
    white-space: nowrap;
}

.enquiry-table td {
    font-size: 13px;
    vertical-align: middle;
}

.filter-box {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.badge-high {
    background: #dc3545;
    color: #fff;
}

.badge-medium {
    background: #ffc107;
    color: #000;
}

.badge-low {
    background: #28a745;
    color: #fff;
}

.badge-open {
    background: #17a2b8;
    color: #fff;
}

.badge-progress {
    background: #fd7e14;
    color: #fff;
}

.badge-closed {
    background: #28a745;
    color: #fff;
}

.action-btn {
    padding: 4px 8px;
    font-size: 12px;
}
</style>

<div class="container-fluid" style="margin-left:20px;">

    <div class="card enquiry-card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Enquiry List
            </h3>

            <a href="{{ route('pages.sales.enquiry.create') }}"
               class="btn btn-primary btn-sm">

                <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                Create Enquiry

            </a>

        </div>

        <div class="card-body">

            <!-- Filters -->
            <div class="filter-box">

                <div class="row">

                    <div class="col-md-3">
                        <input type="text"
                               class="form-control"
                               placeholder="Search Enquiry No / Customer">
                    </div>

                    <div class="col-md-2">
                        <input type="date"
                               class="form-control">
                    </div>

                    <div class="col-md-2">
                        <select class="form-control">
                            <option>Status</option>
                            <option>Open</option>
                            <option>In Progress</option>
                            <option>Closed</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select class="form-control">
                            <option>Priority</option>
                            <option>High</option>
                            <option>Medium</option>
                            <option>Low</option>
                        </select>
                    </div>

                    <div class="col-md-3">

                        <button class="btn btn-primary btn-sm">
                            Search
                        </button>

                        <button class="btn btn-secondary btn-sm">
                            Reset
                        </button>

                    </div>

                </div>

            </div>

            <!-- Table -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover enquiry-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Enquiry No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>
                            <td>ENQ-1001</td>
                            <td>11-06-2026</td>
                            <td>ABC Chemicals Pvt Ltd</td>
                            <td>Liquid Cleaner</td>

                            <td>
                                <span class="badge badge-high">
                                    High
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-open">
                                    Open
                                </span>
                            </td>

                            <td>Rahul Sharma</td>

                            <td>

                                <a href="#"
                                   class="btn btn-info btn-sm action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>

                                </a>

                                <a href="#"
                                   class="btn btn-warning btn-sm action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>

                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>
                            <td>ENQ-1002</td>
                            <td>10-06-2026</td>
                            <td>Prime Hygiene Products</td>
                            <td>Floor Cleaner</td>

                            <td>
                                <span class="badge badge-medium">
                                    Medium
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-progress">
                                    In Progress
                                </span>
                            </td>

                            <td>Neha Jain</td>

                            <td>

                                <a href="#"
                                   class="btn btn-info btn-sm action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>

                                </a>

                                <a href="#"
                                   class="btn btn-warning btn-sm action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>

                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>3</td>
                            <td>ENQ-1003</td>
                            <td>08-06-2026</td>
                            <td>Clean India Chemicals</td>
                            <td>Glass Cleaner</td>

                            <td>
                                <span class="badge badge-low">
                                    Low
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-closed">
                                    Closed
                                </span>
                            </td>

                            <td>Amit Verma</td>

                            <td>

                                <a href="#"
                                   class="btn btn-info btn-sm action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>

                                </a>

                                <a href="#"
                                   class="btn btn-warning btn-sm action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>

                                </a>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->

            <div class="d-flex justify-content-between align-items-center mt-3">

                <small>
                    Showing 1 to 3 of 3 entries
                </small>

                <nav>
                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                Previous
                            </a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link" href="#">
                                1
                            </a>
                        </li>

                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                Next
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </div>

    </div>

</div>

@endsection