@extends('layouts.app')

@section('content')
<?php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $base_color = '#6ab04c';

    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
?>

<section class="main-content-wrapper">
    @include('utilities.messages')

    <!-- Header -->
    <section class="content-header">
        <div style="display:flex; justify-content:space-between; align-items:center; width:100%;">
            <div>
                <h2 class="top-left-header">
                    {{ isset($title) && $title ? $title : 'Non Inventory Items' }}
                </h2>

                <input type="hidden"
                    class="datatable_name"
                    data-title="{{ isset($title) && $title ? $title : '' }}"
                    data-id_name="datatable">
            </div>
        </div>
    </section>

    <div class="box-wrapper">

        <!-- Add Form -->
        <div class="table-box mb-4">
            <h4>Add Non Inventory Item</h4>

            <form action="{{ route('noninventoryitems.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Name <span class="required_star">*</span></label>
                        <input type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter Item Name"
                            value="{{ old('name') }}">

                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Description</label>
                        <input type="text"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter Description"
                            value="{{ old('description') }}">

                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Item
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- List -->
        <div class="table-box">
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('index.sn')</th>
                            <th>@lang('index.name')</th>
                            <th>@lang('index.description')</th>
                            <th>@lang('index.added_by')</th>
                            <th class="ir_txt_center">@lang('index.actions')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($obj as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ getUserName($value->added_by) }}</td>

                            <td class="ir_txt_center">

                                <!-- Edit -->
                                <button type="button"
                                    class="btn btn-sm btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $value->id }}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Delete -->
                                <form action="{{ route('noninventoryitems.destroy', $value->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $value->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('noninventoryitems.update', $value->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="modal-header">
                                            <h5>Edit Non Inventory Item</h5>
                                            <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Name</label>
                                                <input type="text"
                                                    name="name"
                                                    class="form-control"
                                                    value="{{ $value->name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label>Description</label>
                                                <input type="text"
                                                    name="description"
                                                    class="form-control"
                                                    value="{{ $value->description }}">
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>

                                            <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection

@section('script')
<script src="{!! $baseURL . 'assets/datatable_custom/jquery-3.3.1.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/jquery.dataTables.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/dataTables.bootstrap4.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/dataTables.buttons.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/buttons.html5.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/buttons.print.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/jszip.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/pdfmake.min.js' !!}"></script>
<script src="{!! $baseURL . 'assets/dataTable/vfs_fonts.js' !!}"></script>
<script src="{!! $baseURL . 'frequent_changing/newDesign/js/forTable.js' !!}"></script>
<script src="{!! $baseURL . 'frequent_changing/js/custom_report.js' !!}"></script>
@endsection