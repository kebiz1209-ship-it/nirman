@extends('layouts.app')

@section('content')

<style>
.packaging-form label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
    color: #333;
}

.packaging-form .form-control {
    font-size: 12px;
    height: 32px;
    padding: 4px 8px;
}

.packaging-form .btn {
    font-size: 12px;
}

.packaging-form .card-header h4 {
    font-size: 18px;
    margin-bottom: 0;
}

.packaging-form .mb-2 {
    margin-bottom: 10px !important;
}
</style>

<div class="container-fluid packaging-form" style="margin-left:20px;">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create Packaging Material</h4>

            <a href="{{ route('packaging.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('packaging.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-3 mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Packaging Name"
                               required>
                    </div>

                    <!-- Code -->
                    <div class="col-md-3 mb-2">
                        <label>Code <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control"
                               name="code"
                               value="{{ old('code') }}"
                               placeholder="Code"
                               required>
                    </div>

                    <!-- Category -->
                    <div class="col-md-3 mb-2">
                        <label>Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Size -->
                    <div class="col-md-3 mb-2">
                        <label>Size</label>
                        <input type="text"
                               name="size"
                               class="form-control"
                               value="{{ old('size') }}"
                               placeholder="Size">
                    </div>

                    <!-- Weight -->
                    <div class="col-md-3 mb-2">
                        <label>Weight</label>
                        <input type="number"
                               step="0.01"
                               name="weight"
                               class="form-control"
                               value="{{ old('weight') }}"
                               placeholder="Weight">
                    </div>

                    <!-- Height -->
                    <div class="col-md-3 mb-2">
                        <label>Height</label>
                        <input type="number"
                               step="0.01"
                               name="height"
                               class="form-control"
                               value="{{ old('height') }}"
                               placeholder="Height">
                    </div>

                    <!-- Fill Qty -->
                    <div class="col-md-3 mb-2">
                        <label>Fill Qty</label>
                        <input type="number"
                               step="0.01"
                               name="fill_qty"
                               class="form-control"
                               value="{{ old('fill_qty') }}"
                               placeholder="Fill Quantity">
                    </div>

                    <!-- Level -->
                    <div class="col-md-3 mb-2">
                        <label>Level <span class="text-danger">*</span></label>
                        <select name="level" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="Primary" {{ old('level') == 'Primary' ? 'selected' : '' }}>Primary</option>
                            <option value="Secondary" {{ old('level') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                            <option value="Tertiary" {{ old('level') == 'Tertiary' ? 'selected' : '' }}>Tertiary</option>
                        </select>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-3 mb-2">
                        <label>Unit <span class="text-danger">*</span></label>
                        <select name="unit" class="form-control" required>
                            <option value="">Select Unit</option>
                            <option value="KG" {{ old('unit') == 'KG' ? 'selected' : '' }}>KG</option>
                            <option value="LTR" {{ old('unit') == 'LTR' ? 'selected' : '' }}>LTR</option>
                            <option value="PCS" {{ old('unit') == 'PCS' ? 'selected' : '' }}>PCS</option>
                        </select>
                    </div>

                    <!-- Rate Per Unit -->
                    <div class="col-md-3 mb-2">
                        <label>Rate Per Unit</label>
                        <input type="number"
                               step="0.01"
                               name="rate_per_unit"
                               class="form-control"
                               value="{{ old('rate_per_unit') }}"
                               placeholder="Rate Per Unit">
                    </div>

                    <!-- Opening Stock -->
                    <div class="col-md-3 mb-2">
                        <label>Opening Stock</label>
                        <input type="number"
                               step="0.01"
                               name="opening_stock"
                               class="form-control"
                               value="{{ old('opening_stock') }}"
                               placeholder="Opening Stock">
                    </div>

                    <!-- Alert Level -->
                    <div class="col-md-3 mb-2">
                        <label>Alert Level</label>
                        <input type="number"
                               step="0.01"
                               name="alert_level"
                               class="form-control"
                               value="{{ old('alert_level') }}"
                               placeholder="Alert Level">
                    </div>

                    <!-- Status -->
                    <div class="col-md-3 mb-2">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                <hr>

                <div class="text-right">

                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> Save Packaging
                    </button>

                    <button type="reset" class="btn btn-danger btn-sm">
                        Reset
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection