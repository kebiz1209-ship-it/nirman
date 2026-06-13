@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-0 fw-bold">
                Product Details
            </h4>

            <small class="text-muted">
                Complete product master information
            </small>
        </div>

        <div class="d-flex gap-2">

            <a href="#"
               class="btn btn-primary">
                Edit Product
            </a>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </section>

    <!-- PRODUCT INFO -->

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">
                Product Information
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Product Name</label>
                    <div>Bio Growth Plus</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Product Code</label>
                    <div>PRD-001</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Category</label>
                    <div>Bacteria</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Product Type</label>
                    <div>Liquid</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Unit</label>
                    <div>LTR</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">MRP</label>
                    <div>₹ 850</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">GST</label>
                    <div>18%</div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">Status</label>
                    <div>
                        <span class="badge bg-success">
                            Commercial Product
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- FORMULA -->

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">
                Formula Details
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="table-light">

                        <tr>

                            <th>Ingredient</th>
                            <th>Role</th>
                            <th>Qty</th>
                            <th>UOM</th>
                            <th>%</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>Water</td>
                            <td>Base</td>
                            <td>400</td>
                            <td>KG</td>
                            <td>40%</td>
                        </tr>

                        <tr>
                            <td>Special Active X</td>
                            <td>Active</td>
                            <td>250</td>
                            <td>KG</td>
                            <td>25%</td>
                        </tr>

                        <tr>
                            <td>Stabilizer</td>
                            <td>Additive</td>
                            <td>350</td>
                            <td>KG</td>
                            <td>35%</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- COSTING -->

    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">
                Cost Summary
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">
                        Inventory Cost
                    </label>

                    <div>
                        ₹ 12,500
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">
                        Non Inventory Cost
                    </label>

                    <div>
                        ₹ 4,500
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">
                        Manufacturing Cost
                    </label>

                    <div>
                        ₹ 17,000
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="fw-bold">
                        Suggested Selling Price
                    </label>

                    <div>
                        ₹ 21,250
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- ACTIVITY LOG -->

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-light">
            <h5 class="mb-0">
                Activity Log
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="table-light">

                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>01 Jan 2026</td>
                            <td>Admin</td>
                            <td>Created</td>
                        </tr>

                        <tr>
                            <td>05 Jan 2026</td>
                            <td>R&D Head</td>
                            <td>Modified</td>
                        </tr>

                        <tr>
                            <td>08 Jan 2026</td>
                            <td>QA Head</td>
                            <td>Approved</td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection