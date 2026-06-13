@extends('pages.sale-person.layout.app')

@section('content')

<style>
.customer-card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
}

.customer-card .card-header {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
}

.customer-table th {
    font-size: 13px;
    font-weight: 600;
    background: #f8f9fa;
    white-space: nowrap;
}

.customer-table td {
    font-size: 13px;
    vertical-align: middle;
}

.badge-active {
    background: #28a745;
    color: #fff;
}

.badge-inactive {
    background: #dc3545;
    color: #fff;
}

.table-action-btn {
    padding: 4px 8px;
    font-size: 12px;
}

.filter-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 15px;
}

.filter-box .form-control {
    height: 34px;
    font-size: 12px;
}
</style>

<div class="container-fluid" style="margin-left:20px;">

    <div class="card customer-card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Customer Master
            </h3>

            <a href="{{ route('pages.sales.customer.create') }}"
                class="btn btn-primary btn-sm">

                <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                Add Customer

            </a>

        </div>

        <div class="card-body">

            <!-- FILTER SECTION -->
            <div class="filter-box">

                <div class="row">

                    <div class="col-md-3">
                        <input type="text"
                            class="form-control"
                            placeholder="Search Customer">
                    </div>

                    <div class="col-md-2">
                        <input type="text"
                            class="form-control"
                            placeholder="Mobile Number">
                    </div>

                    <div class="col-md-2">
                        <input type="text"
                            class="form-control"
                            placeholder="City">
                    </div>

                    <div class="col-md-2">
                        <select class="form-control">
                            <option>Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
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

            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover customer-table">

                    <thead>

                        <tr>

                            <th width="50">#</th>
                            <th>Customer Code</th>
                            <th>Customer Name</th>
                            <th>Contact Person</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>GST Number</th>
                            <th>Sales Person</th>
                            <th>Status</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>
                            <td>CUS-1001</td>
                            <td>ABC Chemicals Pvt Ltd</td>
                            <td>Rohit Jain</td>
                            <td>9876543210</td>
                            <td>Indore</td>
                            <td>23ABCDE1234F1Z5</td>
                            <td>Rahul Sharma</td>

                            <td>
                                <span class="badge badge-active">
                                    Active
                                </span>
                            </td>

                            <td>

                                <a href="#"
                                    class="btn btn-info btn-sm table-action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>
                                    View

                                </a>

                                <a href="#"
                                    class="btn btn-warning btn-sm table-action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>
                                    Edit

                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>
                            <td>CUS-1002</td>
                            <td>Prime Hygiene Products</td>
                            <td>Amit Patel</td>
                            <td>9988776655</td>
                            <td>Bhopal</td>
                            <td>23XYZAB1234A1Z2</td>
                            <td>Neha Jain</td>

                            <td>
                                <span class="badge badge-active">
                                    Active
                                </span>
                            </td>

                            <td>

                                <a href="#"
                                    class="btn btn-info btn-sm table-action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>
                                    View

                                </a>

                                <a href="#"
                                    class="btn btn-warning btn-sm table-action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>
                                    Edit

                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>3</td>
                            <td>CUS-1003</td>
                            <td>Clean India Chemicals</td>
                            <td>Sachin Verma</td>
                            <td>9123456789</td>
                            <td>Ahmedabad</td>
                            <td>24PQRSX1234M1Z8</td>
                            <td>Amit Verma</td>

                            <td>
                                <span class="badge badge-inactive">
                                    Inactive
                                </span>
                            </td>

                            <td>

                                <a href="#"
                                    class="btn btn-info btn-sm table-action-btn">

                                    <iconify-icon icon="solar:eye-broken"></iconify-icon>
                                    View

                                </a>

                                <a href="#"
                                    class="btn btn-warning btn-sm table-action-btn">

                                    <iconify-icon icon="solar:pen-broken"></iconify-icon>
                                    Edit

                                </a>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->

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