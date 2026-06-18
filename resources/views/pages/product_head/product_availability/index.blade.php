@extends('pages.product_head.layout.app')
@section('content')

<style>
.product-index {
    font-size: 12px;
}

.product-index .content-header h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.product-index .card-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.product-index .form-control {
    height: 32px;
    font-size: 12px;
}

.product-index .btn {
    font-size: 12px;
}

.product-index .table th {
    white-space: nowrap;
    font-size: 12px;
    background: #f8f9fa;
    vertical-align: middle;
}

.product-index .table td {
    font-size: 12px;
    vertical-align: middle;
}

.product-index .badge {
    font-size: 11px;
    padding: 5px 8px;
}

.product-index .card {
    border-radius: 6px;
    border: 1px solid #dee2e6;
}

.product-index .card-header {
    padding: 12px 15px;
}

.product-index label {
    font-size: 12px;
    margin-bottom: 4px;
    font-weight: 600;
}

.product-index .table-responsive {
    overflow-x: auto;
}

.product-index .btn-sm {
    padding: 4px 8px;
    font-size: 11px;
}

.product-index .shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
}

/* Status Badges */
.product-index .badge-success {
    font-size: 11px;
}

.product-index .badge-warning {
    font-size: 11px;
}

.product-index .badge-danger {
    font-size: 11px;
}

.product-index .badge-info {
    font-size: 11px;
}

.product-index .badge-secondary {
    font-size: 11px;
}
</style>
<section class="main-content-wrapper product-index">

    <!-- PAGE HEADER -->
    <section class="content-header d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-0 fw-bold">Product Master</h4>
            <small class="text-muted">
                Manage Product & Formula Details
            </small>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>

    </section>

    <!-- FILTER UI -->

    <div class="card mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">Product Filters</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Product</label>
                    <input type="text" class="form-control" placeholder="Search Product">
                </div>

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Category</label>
                    <select class="form-control">
                        <option>All Categories</option>
                        <option>Bacteria</option>
                        <option>Nano</option>
                        <option>Micoriza</option>
                        <option>Combination</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Product Type</label>
                    <select class="form-control">
                        <option>All Types</option>
                        <option>Liquid</option>
                        <option>Powder</option>
                        <option>Granule</option>
                        <option>Gel</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Status</label>
                    <select class="form-control">
                        <option>All Status</option>
                        <option>Concept</option>
                        <option>R&D Development</option>
                        <option>Pilot Batch</option>
                        <option>Commercial Product</option>
                        <option>Discontinue</option>
                    </select>
                </div>

                <!-- <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Formula Status</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Draft</option>
                        <option>Review</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Availability</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Available</option>
                        <option>Not Available</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-4 mb-3">
                    <label class="font-weight-bold">Commercial Status</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Commercial</option>
                        <option>Sample</option>
                    </select>
                </div> -->

            </div>

            <div class="text-right mt-2">

                <button type="button" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                    Search
                </button>

                <button type="button" class="btn btn-secondary">
                    <i class="fa fa-refresh"></i>
                    Reset
                </button>

            </div>

        </div>

    </div>


    <!-- TABLE UI -->

    <div class="card">

        <!-- <div class="card-header bg-light d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Product List
            </h5>

            <button class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i>
                Add Product
            </button>

        </div> -->

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">

                        <tr>

                            <th width="60">SN</th>

                            <th>Product</th>

                            <th>Code</th>

                            <th>Category</th>

                            <th>Formula</th>

                            <th>Sample</th>

                            <th>Commercial</th>

                            <th>Raw Material</th>

                            <th>Stock</th>

                            <th>Status</th>

                            <th width="180">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>Bio Growth Plus</td>

                            <td>PRD-001</td>

                            <td>Bacteria</td>

                            <td>
                                <span class="badge badge-success">
                                    Approved
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-info">
                                    Yes
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-success">
                                    Commercial
                                </span>
                            </td>

                            <td>12</td>

                            <td>850 KG</td>

                            <td>
                                <span class="badge badge-success">
                                    Active
                                </span>
                            </td>

                            <td>

                                <button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>

                            <td>Nano Shield</td>

                            <td>PRD-002</td>

                            <td>Nano</td>

                            <td>
                                <span class="badge badge-warning">
                                    Draft
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-danger">
                                    No
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-secondary">
                                    Sample
                                </span>
                            </td>

                            <td>8</td>

                            <td>120 KG</td>

                            <td>
                                <span class="badge badge-warning">
                                    Development
                                </span>
                            </td>

                            <td>

                                <button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection