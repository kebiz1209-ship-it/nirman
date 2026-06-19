@extends('layouts.app')

@section('content')

<style>
.material-form {
    font-size: 12px;
}

.material-form label {
    font-size: 12px;
    font-weight: 600;
}

.material-form .form-control {
    height: 32px;
    font-size: 12px;
}

.material-form .card-header h4 {
    margin: 0;
    font-size: 18px;
}

.material-list {
    max-height: 450px;
    overflow-y: auto;
}

.category-card {
    margin-bottom: 10px;
}

.category-header {
    background: #f8f9fa;
    padding: 8px 12px;
    border-bottom: 1px solid #ddd;
}

.material-item {
    padding: 6px 15px;
    border-bottom: 1px solid #f1f1f1;
}

.material-item:last-child {
    border-bottom: none;
}

.select-all-box {
    background: #eef5ff;
    border: 1px solid #cfdfff;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
}
</style>

<div class="container-fluid material-form" style="margin-left:20px;">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h4>Assign Materials To Supplier</h4>
                <small class="text-muted">
                    Supplier :
                    <strong>{{ $supplier->name ?? 'ABC Chemicals Pvt Ltd' }}</strong>
                </small>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('suppliers.supplier.material.store', encrypt_decrypt($supplier->id,'encrypt')) }}"
                method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-4">

                        <label>
                            Material Type
                            <span class="text-danger">*</span>
                        </label>

                        <select name="material_type" id="material_type" class="form-control">

                            <option value="">
                                Select Material Type
                            </option>

                            <option value="raw">
                                Raw Material
                            </option>

                            <option value="packaging">
                                Packaging Material
                            </option>

                        </select>

                    </div>

                </div>

                <hr>

                <!-- RAW MATERIAL SECTION -->

                <div id="rawMaterialSection" style="display:none;">

                    <div class="select-all-box">

                        <label class="mb-0">

                            <input type="checkbox" id="selectAllRaw">

                            <strong>
                                Select All Raw Materials
                            </strong>

                        </label>

                    </div>

                    <div class="material-list">

                        @foreach($rawCategories as $category)

                        <div class="card category-card">

                            <div class="category-header">

                                <label class="mb-0">

                                    <input type="checkbox" class="category-checkbox">

                                    <strong>{{ $category->name }}</strong>

                                </label>

                            </div>

                            <div class="card-body p-0">

                                @if(isset($rawMaterials[$category->id]))

                                @foreach($rawMaterials[$category->id] as $material)

                                <div class="material-item">

                                    <label>

                                        <input type="checkbox"
       name="raw_materials[]"
       value="{{ $material->id }}"
       class="material-checkbox"
       {{ in_array($material->id, $assignedRawMaterials) ? 'checked' : '' }}>

                                        {{ $material->name }}
                                        ({{ $material->code }})

                                    </label>

                                </div>

                                @endforeach

                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- PACKAGING SECTION -->

                <div id="packagingSection" style="display:none;">

                    <div class="select-all-box">

                        <label class="mb-0">

                            <input type="checkbox" id="selectAllPackaging">

                            <strong>
                                Select All Packaging Materials
                            </strong>

                        </label>

                    </div>

                    <div class="material-list">

                        @foreach($packagingCategories as $category)

                        <div class="card category-card">

                            <div class="category-header">

                                <label class="mb-0">

                                    <input type="checkbox" class="packaging-category-checkbox">

                                    <strong>
                                        {{ $category->category_name }}
                                    </strong>

                                </label>

                            </div>

                            <div class="card-body p-0">

                                @if(isset($packagingMaterials[$category->id]))

                                @foreach($packagingMaterials[$category->id] as $material)

                                <div class="material-item">

                                    <label>

                                        <input type="checkbox"
       name="packaging_materials[]"
       value="{{ $material->id }}"
       class="packaging-material-checkbox"
       {{ in_array($material->id, $assignedPackagingMaterials) ? 'checked' : '' }}>

                                        {{ $material->name }}
                                        ({{ $material->code }})

                                    </label>

                                </div>

                                @endforeach

                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <hr>

                <div class="text-right">

                    <button type="submit" class="btn btn-success btn-sm">

                        <i class="fa fa-save"></i>
                        Save Assigned Materials

                    </button>

                    <button type="reset" class="btn btn-danger btn-sm">

                        Reset

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
$(document).ready(function() {

    $('#material_type').change(function() {

        let type = $(this).val();

        if (type == 'raw') {
            $('#rawMaterialSection').show();
            $('#packagingSection').hide();
        } else if (type == 'packaging') {
            $('#packagingSection').show();
            $('#rawMaterialSection').hide();
        } else {
            $('#rawMaterialSection').hide();
            $('#packagingSection').hide();
        }

    });

    $('#selectAllRaw').click(function() {
        $('#rawMaterialSection input[type=checkbox]')
            .prop('checked', $(this).prop('checked'));
    });

    $('.category-checkbox').click(function() {

        $(this)
            .closest('.category-card')
            .find('.material-checkbox')
            .prop('checked', $(this).prop('checked'));

    });

    $('#selectAllPackaging').click(function() {

        $('#packagingSection input[type=checkbox]')
            .prop('checked', $(this).prop('checked'));

    });

    $('.packaging-category-checkbox').click(function() {

        $(this)
            .closest('.category-card')
            .find('.packaging-material-checkbox')
            .prop('checked', $(this).prop('checked'));

    });

});
</script>

@endsection