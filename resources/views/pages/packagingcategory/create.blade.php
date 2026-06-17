@extends('layouts.app')

@section('content')

<style>
    .category-form label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .category-form .form-control {
        font-size: 12px;
        height: 32px;
        padding: 4px 8px;
    }

    .category-form textarea.form-control {
        height: 70px;
        resize: vertical;
    }

    .category-form .btn {
        font-size: 12px;
    }

    .category-form .card-header h4 {
        font-size: 18px;
        margin-bottom: 0;
    }

    .category-form .mb-2 {
        margin-bottom: 10px !important;
    }
</style>

<div class="container-fluid category-form" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create Packaging Category</h4>

            <a href="{{ route('packagingcategory.index') }}"
               class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('packagingcategory.store') }}" method="POST">
    @csrf

                <div class="row">

                    <!-- Category Name -->
                    <div class="col-md-3 mb-2">
                        <label>Category Name <span class="text-danger">*</span></label>
                     <input type="text"
       name="category_name"
       class="form-control"
       placeholder="Enter Category Name"
       value="{{ old('category_name') }}"
       required>
                    </div>

                    <!-- Category Code -->
                    <div class="col-md-3 mb-2">
                        <label>Category Code <span class="text-danger">*</span></label>
                       <input type="text"
       name="category_code"
       class="form-control"
       placeholder="Enter Category Code"
       value="{{ old('category_code') }}"
       required>
                    </div>

                    <!-- Display Order -->
                    <!-- <div class="col-md-3 mb-2">
                        <label>Display Order</label>
                        <input type="number"
                               class="form-control"
                               placeholder="Display Order">
                    </div> -->

                    <!-- Status -->
                    <div class="col-md-3 mb-2">
                        <label>Status</label>
                        <select name="status" class="form-control">
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
</select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-2">
                        <label>Description</label>
                      <textarea name="description"
          class="form-control"
          placeholder="Enter Description">{{ old('description') }}</textarea>
                    </div>

                </div>

                <hr>

                <div class="text-right">

                    <button type="submit"
                            class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> Save Category
                    </button>

                    <button type="reset"
                            class="btn btn-danger btn-sm">
                        Reset
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection