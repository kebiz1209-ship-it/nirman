@extends('layouts.app')

@section('content')

<style>
.material-table {
    font-size: 12px;
}

.material-table .card-header h4 {
    font-size: 18px;
    margin: 0;
}

.material-table .form-control {
    height: 34px;
    font-size: 12px;
}

.material-table .btn {
    font-size: 12px;
}

.material-table table th {
    white-space: nowrap;
    background: #f8f9fa;
    font-weight: 600;
}

.material-table table td {
    vertical-align: middle;
    white-space: nowrap;
}

.material-table .badge {
    font-size: 11px;
    padding: 5px 8px;
}

.material-table .table-responsive {
    overflow-x: auto;
}
</style>

<div class="container-fluid material-table" style="margin-left:20px;">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h4>Supplier Materials</h4>
                <small class="text-muted">
                    Supplier : <strong>{{ $supplier->name }}</strong>
                </small>
            </div>

            <div>

                <a href="{{ route('suppliers.materials.create', encrypt_decrypt($supplier->id, 'encrypt')) }}"
   class="btn btn-primary">
    <i class="fa fa-plus"></i>
    Add Material
</a>

                <a href="#" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>

            </div>

        </div>

        <div class="card-body">

            <!-- Filters -->

            <div class="row mb-3">

                <div class="col-md-3">
                    <label>Material Type</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Raw Material</option>
                        <option>Packaging Material</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Search Material</label>
                    <input type="text" class="form-control" placeholder="Material Name / Code">
                </div>

                <div class="col-md-2">
                    <label>Status</label>
                    <select class="form-control">
                        <option>All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-info btn-block">
                        Search
                    </button>
                </div>

                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button class="btn btn-secondary btn-block">
                        Reset
                    </button>
                </div>

            </div>

            <!-- Table -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Type</th>
                            <th>Material Code</th>
                            <th>Material Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Supplier Rate</th>
                            <th>Lead Time</th>
                            <th>MOQ</th>
                            <th>Status</th>
                            <th width="150">Action</th>

                        </tr>

                    </thead>

                   <tbody>

@if(count($materials))

    @foreach($materials as $key => $item)

        <tr>

            <td>{{ $key + 1 }}</td>

            <td>

                @if($item->raw_material_id)

                    <span class="badge bg-primary">
                        Raw Material
                    </span>

                @else

                    <span class="badge bg-info">
                        Packaging
                    </span>

                @endif

            </td>

            <td>
                {{ $item->raw_code ?? $item->packaging_code }}
            </td>

            <td>
                {{ $item->raw_name ?? $item->packaging_name }}
            </td>

            <td>
                {{ $item->raw_category ?? $item->packaging_category }}
            </td>

            <td>
                {{ $item->raw_unit ?? $item->packaging_unit }}
            </td>

            <td>--</td>

            <td>--</td>

            <td>--</td>

            <td>

                <span class="badge bg-success">
                    Active
                </span>

            </td>

            <td>

                <a href="#"
                   class="btn btn-danger btn-sm">

                    Delete

                </a>

            </td>

        </tr>

    @endforeach

@else

    <tr>

        <td colspan="11" class="text-center">

            No Materials Assigned

        </td>

    </tr>

@endif

</tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection