@extends('layouts.app')

@section('content')

<section class="main-content-wrapper">

    <section class="content-header d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-0 fw-bold">Product List</h4>
            <small class="text-muted">
                Manage all products and formulas
            </small>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Product
        </a>

    </section>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <!-- FILTERS -->
            <div class="row mb-3">

                <div class="col-md-3">
                    <input type="text"
                           class="form-control"
                           placeholder="Search Product">
                </div>

                <div class="col-md-2">
                    <select class="form-control">
                        <option>All Category</option>
                        <option>Bacteria</option>
                        <option>Nano</option>
                        <option>Micoriza</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-control">
                        <option>All Status</option>
                        <option>Concept</option>
                        <option>R&D Development</option>
                        <option>Commercial Product</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">
                        Search
                    </button>
                </div>

            </div>

            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="60">#</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Formula</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>MRP</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>
                                <div class="fw-semibold">
                                    Bio Growth Plus
                                </div>

                                <small class="text-muted">
                                    PRD-001
                                </small>
                            </td>

                            <td>Bacteria</td>

                            <td>Liquid</td>

                            <td>FML-V1</td>

                            <td>
                                <span class="badge bg-success">
                                    Commercial
                                </span>
                            </td>

                            <td>AgriCrop Pvt Ltd</td>

                            <td>₹ 850</td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('products.show',1) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="#"
                                       class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>

                            <td>
                                <div class="fw-semibold">
                                    Nano Power Max
                                </div>

                                <small class="text-muted">
                                    PRD-002
                                </small>
                            </td>

                            <td>Nano</td>

                            <td>Powder</td>

                            <td>FML-V2</td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Trial
                                </span>
                            </td>

                            <td>Green Field Agro</td>

                            <td>₹ 1250</td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('products.show',2) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="#"
                                       class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </div>

                            </td>

                        </tr>

                        <tr>

                            <td>3</td>

                            <td>
                                <div class="fw-semibold">
                                    Root Activator
                                </div>

                                <small class="text-muted">
                                    PRD-003
                                </small>
                            </td>

                            <td>Combination</td>

                            <td>Gel</td>

                            <td>FML-V3</td>

                            <td>
                                <span class="badge bg-secondary">
                                    Concept
                                </span>
                            </td>

                            <td>Kashish Organics</td>

                            <td>₹ 650</td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a href="{{ route('products.show',3) }}"
                                       class="btn btn-info btn-sm">
                                        View
                                    </a>

                                    <a href="#"
                                       class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                    <button class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection