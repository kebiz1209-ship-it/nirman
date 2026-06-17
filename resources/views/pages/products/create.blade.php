@extends('layouts.app')
@section('script_top')
<?php
    $setting = getSettingsInfo();
    $tax_setting = getTaxInfo();
    $baseURL = getBaseURL();
?>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ $baseURL. 'assets/bower_components/jquery-ui/jquery-ui.css' }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('assets/modules/css/product.css') }}">

@endpush

@section('content')
<section class="main-content-wrapper">
    <section class="content-header d-flex justify-content-between align-items-center mb-3">
       <div>
        <h4 class="mb-0 fw-bold">Add Product</h4>
        <small class="text-muted">
            Create and manage product master information
        </small>
    </div>
        <a href="{{ route('finishedproducts.index') }}" class="btn btn-secondary back-btn">
            <i class="fa fa-arrow-left"></i> Back
        </a>
    </section>

    <!-- <div class="box-wrapper"> -->
        <div class="table-box">
            <form method="POST" action="{{ route('products.store') }}" id="productForm">
                @csrf

              
                <!-- Tabs Navigation -->
                <div class="product-tabs">
                    <ul class="nav nav-tabs flex-wrap" id="productTabs" role="tablist">

                        <li class="nav-item">
                            <button class="nav-link active" id="product-info-tab" data-bs-toggle="tab"
                                data-bs-target="#product-info" type="button">
                                Product Info
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="formula-tab" data-bs-toggle="tab" data-bs-target="#formula"
                                type="button">
                                Formula
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="varient-tab" data-bs-toggle="tab"
                                data-bs-target="#varient" type="button">
                               varient
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="ingredient-tab" data-bs-toggle="tab"
                                data-bs-target="#ingredient" type="button">
                                Ingredient
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="base-compound-tab" data-bs-toggle="tab"
                                data-bs-target="#base-compound" type="button">
                                Base Compound
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="packaging-tab" data-bs-toggle="tab" data-bs-target="#packaging"
                                type="button">
                                Packaging
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="production-tab" data-bs-toggle="tab"
                                data-bs-target="#production" type="button">
                                Production
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="quality-tab" data-bs-toggle="tab" data-bs-target="#quality"
                                type="button">
                                Quality
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="costing-tab" data-bs-toggle="tab" data-bs-target="#costing"
                                type="button">
                                Costing
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents"
                                type="button">
                                Documents
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security"
                                type="button">
                                Security & Access
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" id="audit-tab" data-bs-toggle="tab" data-bs-target="#audit"
                                type="button">
                                Audit Trail
                            </button>
                        </li>

                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content" id="productTabsContent">

                    <div class="tab-pane fade show active" id="product-info" role="tabpanel">
                        @include('pages.products.partials.product-info')
                    </div>

                    <div class="tab-pane fade" id="formula" role="tabpanel">
                        @include('pages.products.partials.formula')
                    </div>

                    <div class="tab-pane fade" id="varient" role="tabpanel">
                        @include('pages.products.partials.varient')
                    </div>

                    <div class="tab-pane fade" id="ingredient" role="tabpanel">
                        @include('pages.products.partials.ingredient')
                    </div>

                    <div class="tab-pane fade" id="base-compound" role="tabpanel">
                        @include('pages.products.partials.base-compound')
                    </div>

                    <div class="tab-pane fade" id="packaging" role="tabpanel">
                        @include('pages.products.partials.packaging')
                    </div>

                    <div class="tab-pane fade" id="production" role="tabpanel">
                        @include('pages.products.partials.production')
                    </div>

                    <div class="tab-pane fade" id="quality" role="tabpanel">
                        @include('pages.products.partials.quality')
                    </div>

                    <div class="tab-pane fade" id="costing" role="tabpanel">
                        @include('pages.products.partials.costing')
                    </div>

                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        @include('pages.products.partials.documents')
                    </div>

                    <div class="tab-pane fade" id="security" role="tabpanel">
                        @include('pages.products.partials.security')
                    </div>

                    <div class="tab-pane fade" id="audit" role="tabpanel">
                        @include('pages.products.partials.audit')
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="row mt-3">
                    <div class="col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    <!-- </div> -->
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Optional: Add validation before submit
document.getElementById('productForm').addEventListener('submit', function(e) {
    // Add any validation logic here if needed
    console.log('Form submitted');
});
</script>
@endpush