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
    <section class="content-header">
        <div style="display:flex; justify-content:space-between; align-items:center; width:100%;">

            <!-- Left Side Title -->
            <div>
                <h2 class="top-left-header">
                    {{ isset($title) && $title ? $title : '' }}
                </h2>

                <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                    data-id_name="datatable">
            </div>

            <!-- Right Side Button -->
            <div>
                @if (routePermission('rm.create'))
                <a href="{{ route('rawmaterials.create') }}"
                    class="btn btn-primary {{ request()->routeIs('rawmaterials.create') ? 'active' : '' }}">
                    <i class="fa fa-plus"></i> @lang('index.add_raw_material')
                </a>
                @endif
            </div>

        </div>
    </section>


    <div class="box-wrapper">

        <div class="table-box">
            <!-- /.box-header -->
            <div class="table-responsive">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="width_1_p">@lang('index.sn')</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Grade</th>
                            <th>Potency</th>
                            <th>Alias</th>
                            <th>Level</th>
                            <th>Unit</th>
                            <th>Rate/Unit</th>
                            <th>Opening Stock</th>
                            <th>Alert Level</th>
                            <th>Status</th>
                            <th class="width_3_p ir_txt_center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($obj && !empty($obj))
                        <?php
                                $i = count($obj);
                                ?>
                        @endif
                        @foreach ($obj as $value)
                        <tr>
                            <td class="c_center">{{ $loop->iteration }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->code }}</td>
                            <td>{{ getCategoryById($value->category) }}</td>
                            <td>{{ $value->grade ?? '-' }}</td>
                            <td>{{ $value->potency ?? '-' }}</td>
                            <td>{{ $value->alias ?? '-' }}</td>
                            <td>{{ getRMUnitById($value->unit) }}</td>
                            <td>{{ getAmtCustom($value->rate_per_unit) }}</td>
                            <td>{{ getRMUnitById($value->consumption_unit) }}</td>
                            <td>{{ $value->conversion_rate }}</td>
                            <td>{{ getAmtCustom($value->rate_per_consumption_unit) }}</td>
                            <td>{{ openingStock($value->id) }}</td>
                            <td class="ir_txt_center">
                                @if (routePermission('rm.edit'))
                                <a href="{{ url('rawmaterials') }}/{{ encrypt_decrypt($value->id, 'encrypt') }}/edit"
                                    class="button-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.edit')"><i class="fa fa-edit tiny-icon"></i></a>
                                @endif
                                @if (routePermission('rm.delete'))
                                <a href="#" class="delete button-danger" data-form_class="alertDelete{{ $value->id }}"
                                    type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="@lang('index.delete')">
                                    <form action="{{ route('rawmaterials.destroy', $value->id) }}"
                                        class="alertDelete{{ $value->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <i class="fa fa-trash tiny-icon"></i>
                                    </form>
                                </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
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