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

            <form action="{{ route('packaging.store') }}" method="POST">
    @csrf

                <div class="row">

                    <!-- Name -->
                    <div class="col-md-3 mb-2">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control" name="name"
                               placeholder="Packaging Name">
                    </div>

                    <!-- Code -->
                    <div class="col-md-3 mb-2">
                        <label>Code <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control" name="code"
                               placeholder="Code">
                    </div>

                    <!-- Category -->
                    <div class="col-md-3 mb-2">
                        <label>Category</label>
                       <select name="category_id" class="form-control">
    <option value="">Select Category</option>

    @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->category_name }}
        </option>
    @endforeach
</select>
                    </div>

                    <!-- Size -->
                    <div class="col-md-3 mb-2">
                        <label>Size</label>
                        <input type="text" name="size" 
                               class="form-control"
                               placeholder="Size">
                    </div>

                    <!-- Weight -->
                    <div class="col-md-3 mb-2">
                        <label>Weight</label>
                        <input type="number"  step="0.01"
                               class="form-control"
                               placeholder="Weight">
                    </div>

                    <!-- Height -->
                    <div class="col-md-3 mb-2">
                        <label>Height</label>
                        <input type="number"  step="0.01"
                               class="form-control"
                               placeholder="Height">
                    </div>

                    <!-- Fill Qty -->
                    <div class="col-md-3 mb-2">
                        <label>Fill Qty</label>
                        <input type="number"  step="0.01"
                               class="form-control"
                               placeholder="Fill Quantity">
                    </div>

                    <!-- Level -->
                    <div class="col-md-3 mb-2">
                        <label>Level</label>
                        <select class="form-control"  name="level" >
                            <option>Select Level</option>
                            <option>Primary</option>
                            <option>Secondary</option>
                            <option>Tertiary</option>
                        </select>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-3 mb-2">
                        <label>Unit</label>
                        <select class="form-control" name="unit" >
                            <option>Select Unit</option>
                            <option>PCS</option>
                            <option>KG</option>
                            <option>GM</option>
                            <option>LTR</option>
                            <option>ML</option>
                            <option>BOX</option>
                        </select>
                    </div>

                    <!-- Rate Per Unit -->
                    <div class="col-md-3 mb-2">
                        <label>Rate Per Unit</label>
                        <input type="number" step="0.01"
                               class="form-control"
                               placeholder="Rate">
                    </div>

                    <!-- Opening Stock -->
                    <div class="col-md-3 mb-2">
                        <label>Opening Stock</label>
                        <input type="number" step="0.01"
                               class="form-control"
                               placeholder="Opening Stock">
                    </div>

                    <!-- Alert Level -->
                    <div class="col-md-3 mb-2">
                        <label>Alert Level</label>
                        <input type="number" step="0.01"
                               class="form-control"
                               placeholder="Alert Level">
                    </div>

                    <!-- Status -->
                    <div class="col-md-3 mb-2">
                        <label>Status</label>
                        <select class="form-control" name="status" >
                            <option>Active</option>
                            <option>Inactive</option>
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