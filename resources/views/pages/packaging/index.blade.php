@extends('layouts.app')

@section('content')

<style>
.packaging-table {
    font-size: 12px;
}

.packaging-table .card-header h4 {
    font-size: 18px;
    margin-bottom: 0;
}

.packaging-table .form-control {
    height: 32px;
    font-size: 12px;
    padding: 4px 8px;
}

.packaging-table .btn {
    font-size: 12px;
    padding: 4px 10px;
}

.packaging-table table {
    margin-bottom: 0;
}

.packaging-table table th {
    font-size: 12px;
    font-weight: 600;
    padding: 8px 6px;
    white-space: nowrap;
    background: #f8f9fa;
    vertical-align: middle;
}

.packaging-table table td {
    font-size: 12px;
    padding: 6px;
    vertical-align: middle;
    white-space: nowrap;
}

.packaging-table .badge {
    font-size: 11px;
    padding: 4px 7px;
}

.packaging-table .btn-sm {
    font-size: 11px;
    padding: 3px 8px;
}

.packaging-table .table-responsive {
    overflow-x: auto;
}
</style>

<div class="container-fluid packaging-table" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Packaging List</h4>

            <a href="{{ route('packaging.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Packaging
            </a>
        </div>

        <div class="card-body">

            <!-- Search Area -->
            <div class="row mb-3">

                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search Name / Code">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-info">
                        Search
                    </button>
                </div>

            </div>

            

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Fill Qty</th>
                            <th>Level</th>
                            <th>Unit</th>
                            <th>Rate Per Unit</th>
                            <th>Opening Stock</th>
                            <th>Alert Level</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>

                   <tbody>

@if($packagings->count())

    @foreach($packagings as $key => $packaging)

    <tr>
        <td>{{ $key + 1 }}</td>

        <td>{{ $packaging->name }}</td>

        <td>{{ $packaging->code }}</td>

        <td>
            {{ $packaging->category->category_name ?? '-' }}
        </td>

        <td>{{ $packaging->size }}</td>

        <td>{{ $packaging->weight }}</td>

        <td>{{ $packaging->height }}</td>

        <td>{{ $packaging->fill_qty }}</td>

        <td>
    @if($packaging->level == 'Primary')
        <span class="badge bg-primary">Primary</span>
    @elseif($packaging->level == 'Secondary')
        <span class="badge bg-info">Secondary</span>
    @else
        <span class="badge bg-dark">Tertiary</span>
    @endif
</td>

        <td>{{ $packaging->unit }}</td>

        <td>₹ {{ number_format($packaging->rate_per_unit, 2) }}</td>

        <td>{{ $packaging->opening_stock }}</td>

        <td>{{ $packaging->alert_level }}</td>

        <td>
    @if($packaging->status == 'Active')
        <span class="badge bg-success">Active</span>
    @else
        <span class="badge bg-danger">Inactive</span>
    @endif
</td>

        <td>
            <a href="{{ route('packaging.edit', $packaging->id) }}"
               class="btn btn-sm btn-warning">
                Edit
            </a>
        </td>
    </tr>

    @endforeach

@else

<tr>
    <td colspan="15" class="text-center">
        No Records Found
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