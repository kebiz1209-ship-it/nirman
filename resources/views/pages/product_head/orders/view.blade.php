@extends('pages.product_head.layout.app')

@section('content')

<section class="main-content-wrapper">

    <!-- HEADER -->
    <section class="content-header d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-0 fw-bold">Product Details</h4>
            <small class="text-muted">Complete product & formula master information</small>
        </div>

        <div class="d-flex gap-2">
            <!-- <a href="#" class="btn btn-primary">Edit Product</a> -->
            <a href="{{ route('pages.product-head.orders') }}" class="btn btn-secondary">Back</a>
        </div>

    </section>

    <!-- PRODUCT INFO -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-light">
            <h5 class="mb-0">Product Information</h5>
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
                    <label class="fw-bold">Type</label>
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
                    <div><span class="badge bg-success">Commercial Product</span></div>
                </div>

            </div>
        </div>
    </div>

    <!-- FORMULA DETAILS -->
    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">Formula Details</h5>
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
                            <td>Active X</td>
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

    <!-- VARIANT -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-light">
            <h5 class="mb-0">Variant</h5>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Variant Code</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Description</label>
                    <textarea class="form-control"></textarea>
                </div>

            </div>
        </div>
    </div>

    <!-- BATCH INFORMATION -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-light">
            <h5 class="mb-0">Batch Information</h5>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Total Batch Qty</label>
                    <input type="number" class="form-control" value="1000">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Adjustment Type</label>
                    <select class="form-control">
                        <option>Same</option>
                        <option>Increase</option>
                        <option>Decrease</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Adjustment Qty</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Concurrent Batch</label>
                    <input type="number" class="form-control" value="1000">
                </div>

            </div>
        </div>
    </div>

    <!-- INGREDIENTS -->
    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light d-flex justify-content-between">
            <h5 class="mb-0">Ingredients</h5>
            <button class="btn btn-primary btn-sm">+ Add Ingredient</button>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead class="table-light">
                        <tr>
                            <th>Seq</th>
                            <th>Code</th>
                            <th>Ingredient</th>
                            <th>Role</th>
                            <th>Qty</th>
                            <th>%</th>
                            <th>Visible</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>ING001</td>
                            <td>Water</td>
                            <td>Base</td>
                            <td>800</td>
                            <td>80</td>
                            <td>Yes</td>
                            <td><button class="btn btn-danger btn-sm">Remove</button></td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- COST SUMMARY -->
    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">Cost Summary</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Inventory Cost</label>
                    <input type="text" class="form-control" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Non Inventory Cost</label>
                    <input type="text" class="form-control" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Total Cost</label>
                    <input type="text" class="form-control" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Margin %</label>
                    <input type="number" class="form-control" value="25">
                </div>

            </div>

        </div>
    </div>

    <!-- FINAL COMPOSITION -->
    <div class="card border-0 shadow-sm mb-3">

        <div class="card-header bg-light">
            <h5 class="mb-0">Final Formula Composition</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Component</th>
                        <th>Type</th>
                        <th>%</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Compound A</td>
                        <td>Secret</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>Compound B</td>
                        <td>Base</td>
                        <td>35%</td>
                    </tr>
                    <tr>
                        <td>Fragrance</td>
                        <td>Direct</td>
                        <td>5%</td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>

    <!-- ACTIVITY LOG -->
    <!-- <div class="card border-0 shadow-sm">

        <div class="card-header bg-light">
            <h5 class="mb-0">Activity Log</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
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
                        <td>R&D</td>
                        <td>Modified</td>
                    </tr>
                    <tr>
                        <td>08 Jan 2026</td>
                        <td>QA</td>
                        <td>Approved</td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div> -->

</section>

@endsection