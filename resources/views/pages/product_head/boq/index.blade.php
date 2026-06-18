@extends('pages.product_head.layout.app')

@section('content')

<style>
.boq-index {
    font-size: 12px;
}

.boq-index .card-header h4 {
    margin: 0;
    font-size: 18px;
}

.boq-index .form-control {
    height: 32px;
    font-size: 12px;
}

.boq-index .btn {
    font-size: 12px;
}

.boq-index table th {
    white-space: nowrap;
    font-size: 12px;
    background: #f8f9fa;
}

.boq-index table td {
    vertical-align: middle;
    font-size: 12px;
}

.boq-index .badge {
    font-size: 11px;
    padding: 5px 8px;
}
</style>

<div class="container-fluid boq-index" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h4>Bill of Quantities (BOQ)</h4>
                <small>
                    Manage order-wise bill of quantities and material planning.
                </small>
            </div>

            <a href="{{ route('pages.product-head.boq.create') }}"
               class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>
                Create BOQ
            </a>

        </div>

        <div class="card-body">

            <!-- Filters -->

            <div class="row mb-3">

                <div class="col-md-3">

                    <label>Order No</label>

                    <input type="text"
                           class="form-control"
                           placeholder="Search Order No">

                </div>

                <div class="col-md-3">

                    <label>Customer</label>

                    <input type="text"
                           class="form-control"
                           placeholder="Search Customer">

                </div>

                <div class="col-md-2">

                    <label>Status</label>

                    <select class="form-control">

                        <option>All</option>
                        <option>Draft</option>
                        <option>Approved</option>
                        <option>Completed</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <label>&nbsp;</label>

                    <button class="btn btn-info btn-block">
                        Search
                    </button>

                </div>

            </div>

            <!-- BOQ Table -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Order No</th>

                            <th>Customer</th>

                            <th>Product</th>

                            <th>Order Qty</th>

                            <th>BOQ Items</th>

                            <th>Total Cost</th>

                            <th>Status</th>

                            <th>Created By</th>

                            <th>Created Date</th>

                            <th width="220">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>ORD-001</td>

                            <td>ABC Chemicals</td>

                            <td>Bio Fertilizer</td>

                            <td>1000 KG</td>

                            <td>18</td>

                            <td>₹ 45,000</td>

                            <td>
                                <span class="badge badge-warning">
                                    Draft
                                </span>
                            </td>

                            <td>Admin</td>

                            <td>18-Jun-2026</td>

                            <td>

                                <a href="#"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('pages.product-head.boq.create') }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>

                            <td>ORD-002</td>

                            <td>XYZ Industries</td>

                            <td>Plant Growth Promoter</td>

                            <td>500 KG</td>

                            <td>12</td>

                            <td>₹ 22,500</td>

                            <td>
                                <span class="badge badge-success">
                                    Approved
                                </span>
                            </td>

                            <td>Manager</td>

                            <td>17-Jun-2026</td>

                            <td>

                                <a href="#"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="#"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td colspan="11"
                                class="text-center">

                                No Records Found

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection