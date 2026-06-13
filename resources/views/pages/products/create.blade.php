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
<style>
/* GLOBAL FORM LOOK */
.main-content-wrapper,
.main-content-wrapper * {
    font-family: inherit !important;
}

/* LABEL STYLE */
.form-group label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
    color: #495057;
    text-transform: uppercase;
    letter-spacing: .3px;
}

.form-control,
.select2-container--default .select2-selection--single {
    height: 36px !important;
    font-size: 13px !important;
    border-radius: 4px;
    padding: 6px 10px;
}

.form-control:focus {
    border-color: #93c5fd !important;
    box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, .15) !important;
}

/* TEXTAREA */
textarea.form-control {
    min-height: 80px;
}

/* ROW SPACING */
.row {
    margin-bottom: 6px;
}

/* FORM GROUP SPACING */
.form-group {
    margin-bottom: 10px;
}

/* ERROR TEXT */
.text-danger {
    font-size: 12px;
}

.content-header {
    margin-bottom: 15px;
}

.back-btn {
    font-size: 12px !important;
    padding: 7px 14px !important;
    border-radius: 6px !important;
    font-weight: 600;
}

/* ALL DROPDOWNS */
select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    /* height: 42px !important; */
    border: 1px solid #d1d5db !important;
    border-radius: 6px !important;
    padding-right: 45px !important;
    background-color: #fff !important;
    background-image:
        linear-gradient(45deg, transparent 50%, #6b7280 50%),
        linear-gradient(135deg, #6b7280 50%, transparent 50%);
    background-position:
        calc(100% - 18px) calc(50% - 3px),
        calc(100% - 12px) calc(50% - 3px);
    background-size: 6px 6px;
    background-repeat: no-repeat;
    font-size: 14px !important;
    color: #374151 !important;
}

select.form-control:focus {
    border-color: #93c5fd !important;
    box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, .15) !important;
    outline: none !important;
}

/* TABS STYLING */
.product-tabs {
      margin-bottom: 15px;
    border-bottom: 1px solid #dee2e6;
}

.nav-tabs {
   
    gap: 2px;
}

.nav-tabs .nav-link {
   padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 4px 4px 0 0;
}

.nav-tabs .nav-link:hover {
    color: #3b82f6;
    background: #f3f4f6;
    border: none;
}

.nav-tabs .nav-link.active {
    background: #0d6efd;
    color: #fff;
    border-bottom: none;
}

.tab-content {
    padding: 12px 0;
}

/* CHECKBOX STYLES */
.checkbox-container {
    background: #f9fafb;
    border-radius: 8px;
    padding: 15px;
    border: 1px solid #e5e7eb;
}

.checkbox-title {
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 15px;
    font-size: 14px;
}

.checkbox-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.checkbox-box {
    display: flex;
    align-items: center;
}

.checkbox-box input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin-right: 8px;
    cursor: pointer;
}

.checkbox-box label {
    margin-bottom: 0;
    cursor: pointer;
    font-weight: normal;
    font-size: 14px;
}

.btn-primary {
    background: #3b82f6;
    border: none;
    padding: 10px 24px;
    border-radius: 6px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #2563eb;
}

.d-flex {
    display: flex;
}

.gap-2 {
    gap: 10px;
}
.table-box {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 18px;
    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
</style>
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