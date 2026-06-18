@extends('pages.product_head.layout.app')

@section('content')

<style>
.activity-order-table {
    font-size: 12px;
}

.activity-order-table .card-header h4 {
    margin: 0;
    font-size: 18px;
}

.activity-order-table table th,
.activity-order-table table td {
    vertical-align: middle;
    white-space: nowrap;
}
</style>

<div class="container-fluid activity-order-table" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Activity Planning Orders</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>ORD-001</td>
                            <td>ABC Chemicals</td>
                            <td>Bio Fertilizer</td>
                            <td>5000 KG</td>
                            <td>25-06-2026</td>
                            <td>
                                <span class="badge badge-warning">
                                    Pending Planning
                                </span>
                            </td>
                                                      <td>
    <a href="{{ route('pages.product-head.activity.create') }}"
       class="btn btn-primary btn-sm">
        <i class="fa fa-tasks"></i>
        Plan Activities
    </a>
</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>ORD-002</td>
                            <td>XYZ Agro</td>
                            <td>Growth Booster</td>
                            <td>2500 KG</td>
                            <td>28-06-2026</td>
                            <td>
                                <span class="badge badge-success">
                                    Planned
                                </span>
                            </td>
                          <td>
    <a href="{{ route('pages.product-head.activity.create') }}"
       class="btn btn-primary btn-sm">
        <i class="fa fa-tasks"></i>
        Plan Activities
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