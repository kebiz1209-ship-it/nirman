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
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header">{{ isset($title) && $title ? $title : '' }}</h2>
                    <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                        data-id_name="datatable">
                </div>
                <div class="col-md-offset-4 col-md-2">
                    
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
                                <th class="width_10_p">@lang('index.transfer_reference_no')</th>
                                <th class="width_10_p">@lang('index.transfer_date')</th>
                                <th class="width_10_p">@lang('index.from_outlet')</th>
                                <th class="width_10_p">@lang('index.to_outlet')</th>
                                <th class="width_10_p">@lang('index.transfer_status')</th>
                                <th class="width_10_p">@lang('index.added_by')</th>
                                <th class="width_3_p">@lang('index.actions')</th>
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
                                    <td class="c_center">{{ $i-- }}</td>
                                    <td>{{ $value->transfer_reference_no }}</td>
                                    <td>{{ getDateFormat($value->transfer_date) }}</td>
                                    <td>{{ $value->fromOutlet ? $value->fromOutlet->outlet_name : 'N/A' }}</td>
                                    <td>{{ $value->toOutlet ? $value->toOutlet->outlet_name : 'N/A' }}</td>
                                    <td>
                                        @if ($value->transfer_status == 'Completed')
                                            <span class="badge bg-success">{{ $value->transfer_status }}</span>
                                        @elseif ($value->transfer_status == 'Cancelled')
                                            <span class="badge bg-danger">{{ $value->transfer_status }}</span>
                                        @elseif ($value->transfer_status == 'In Transit')
                                            <span class="badge bg-info">{{ $value->transfer_status }}</span>
                                        @elseif ($value->transfer_status == 'Pending')
                                            <span class="badge bg-warning">{{ $value->transfer_status }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $value->transfer_status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ getUserName($value->added_by) }}</td>
                                    @if (in_array($value->transfer_status, ['Completed', 'Cancelled']))
                                        <td>
                                            @if (routePermission('raw-material-transfer.view'))
                                                <a href="{{ route('raw-material-transfers.show', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('index.view_details')"><i class="fa fa-eye tiny-icon"></i></a>
                                            @endif
                                            @if (routePermission('raw-material-transfer.print'))
                                                <a href="{{ route('raw-material-transfers.print', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                    target="_blank" class="button-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="@lang('index.print')"><i
                                                        class="fa fa-print tiny-icon"></i></a>
                                            @endif
                                        </td>
                                    @else
                                        <td class="ir_txt_center">
                                            @if (routePermission('raw-material-transfer.view'))
                                                <a href="{{ route('raw-material-transfers.show', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                    class="button-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="@lang('index.view_details')"><i class="fa fa-eye tiny-icon"></i></a>
                                            @endif
                                            @if ($value->transfer_status == 'Draft')
                                                @if (routePermission('raw-material-transfer.edit'))
                                                    <a href="{{ route('raw-material-transfers.edit', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                        class="button-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('index.edit')"><i class="fa fa-edit tiny-icon"></i></a>
                                                @endif
                                                @if (routePermission('raw-material-transfer.delete'))
                                                    <a href="#" class="delete button-danger"
                                                        data-form_class="alertDelete{{ $value->id }}" type="submit"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('index.delete')">
                                                        <form action="{{ route('raw-material-transfers.destroy', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                            class="alertDelete{{ $value->id }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <i class="c_padding_13 fa fa-trash tiny-icon"></i>
                                                        </form>
                                                    </a>
                                                @endif
                                            @endif
                                            @if (in_array($value->transfer_status, ['Draft', 'Pending']))
                                                @if (routePermission('raw-material-transfer.approve'))
                                                    <a href="javascript:void(0);" class="button-warning approve-transfer"
                                                        data-id="{{ encrypt_decrypt($value->id, 'encrypt') }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('index.approve')"><i class="fa fa-check tiny-icon"></i></a>
                                                @endif
                                            @endif
                                            @if (in_array($value->transfer_status, ['Pending', 'In Transit']))
                                                @if (routePermission('raw-material-transfer.complete'))
                                                    <a href="javascript:void(0);" class="button-success complete-transfer"
                                                        data-id="{{ encrypt_decrypt($value->id, 'encrypt') }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('index.complete')"><i class="fa fa-check-circle tiny-icon"></i></a>
                                                @endif
                                            @endif
                                            @if (in_array($value->transfer_status, ['Draft', 'Pending']))
                                                @if (routePermission('raw-material-transfer.cancel'))
                                                    <a href="javascript:void(0);" class="button-danger cancel-transfer"
                                                        data-id="{{ encrypt_decrypt($value->id, 'encrypt') }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('index.cancel')"><i class="fa fa-times tiny-icon"></i></a>
                                                @endif
                                            @endif
                                            @if (routePermission('raw-material-transfer.print'))
                                                <a href="{{ route('raw-material-transfers.print', encrypt_decrypt($value->id, 'encrypt')) }}"
                                                    target="_blank" class="button-info" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="@lang('index.print')"><i
                                                        class="fa fa-print tiny-icon"></i></a>
                                            @endif
                                        </td>
                                    @endif
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
    <script>
        $(document).ready(function() {
            let hidden_alert = $("#hidden_alert").val();
            let hidden_cancel = $("#hidden_cancel").val();
            let hidden_ok = $("#hidden_ok").val();
            let are_you_sure = '@lang('index.are_you_sure')';

            $('.approve-transfer').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: hidden_alert + "!",
                    text: are_you_sure,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: hidden_ok,
                    cancelButtonText: hidden_cancel,
                    confirmButtonColor: "#3c8dbc",
                }, function(isConfirm) {
                    if (isConfirm) {
                        var form = $('<form>', {
                            'method': 'POST',
                            'action': '/raw-material-transfers/' + id + '/approve'
                        });
                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }));
                        $('body').append(form);
                        form.submit();
                    }
                });
            });

            $('.complete-transfer').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: hidden_alert + "!",
                    text: are_you_sure,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: hidden_ok,
                    cancelButtonText: hidden_cancel,
                    confirmButtonColor: "#3c8dbc",
                }, function(isConfirm) {
                    if (isConfirm) {
                        var form = $('<form>', {
                            'method': 'POST',
                            'action': '/raw-material-transfers/' + id + '/complete'
                        });
                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }));
                        $('body').append(form);
                        form.submit();
                    }
                });
            });

            $('.cancel-transfer').on('click', function() {
                var id = $(this).data('id');
                swal({
                    title: hidden_alert + "!",
                    text: are_you_sure,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: hidden_ok,
                    cancelButtonText: hidden_cancel,
                    confirmButtonColor: "#3c8dbc",
                }, function(isConfirm) {
                    if (isConfirm) {
                        var form = $('<form>', {
                            'method': 'POST',
                            'action': '/raw-material-transfers/' + id + '/cancel'
                        });
                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '{{ csrf_token() }}'
                        }));
                        $('body').append(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
