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
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/css/backup.css' !!}">

    <!-- Hidden inputs for language strings and base URL -->
    <input type="hidden" id="hidden_base_url" value="{{ getBaseURL() }}">
    <input type="hidden" id="hidden_alert" value="@lang('index.alert')">
    <input type="hidden" id="hidden_cancel" value="@lang('index.cancel')">
    <input type="hidden" id="hidden_ok" value="@lang('index.ok')">
    <input type="hidden" id="create_backup" value="@lang('index.create_backup')">
    <input type="hidden" id="are_you_sure_create_backup" value="@lang('index.are_you_sure_create_backup')">
    <input type="hidden" id="yes_create" value="@lang('index.yes_create')">
    <input type="hidden" id="restore_backup" value="@lang('index.restore_backup')">
    <input type="hidden" id="are_you_sure_restore_backup" value="@lang('index.are_you_sure_restore_backup')">
    <input type="hidden" id="yes_restore" value="@lang('index.yes_restore')">
    <input type="hidden" id="delete_backup" value="@lang('index.delete_backup')">
    <input type="hidden" id="are_you_sure_delete_backup" value="@lang('index.are_you_sure_delete_backup')">
    <input type="hidden" id="yes_delete" value="@lang('index.yes_delete')">
    <input type="hidden" id="success" value="@lang('index.success')">
    <input type="hidden" id="error" value="@lang('index.error')">
    <input type="hidden" id="backup_exists" value="@lang('index.backup_exists')">
    <input type="hidden" id="today_backup_exists_message" value="@lang('index.today_backup_exists_message')">
    <input type="hidden" id="backup_created_successfully" value="@lang('index.backup_created_successfully')">
    <input type="hidden" id="backup_restored_successfully" value="@lang('index.backup_restored_successfully')">
    <input type="hidden" id="backup_failed" value="@lang('index.backup_failed')">
    <input type="hidden" id="restore_failed" value="@lang('index.restore_failed')">
    <input type="hidden" id="something_went_wrong" value="@lang('index.something_went_wrong')">
    <input type="hidden" id="creating_backup" value="@lang('index.creating_backup')">
    <input type="hidden" id="restoring_backup" value="@lang('index.restoring_backup')">
    <input type="hidden" id="backup_completed" value="@lang('index.backup_completed')">
    <input type="hidden" id="restore_completed" value="@lang('index.restore_completed')">
    <input type="hidden" id="failed_to_load_backup_details" value="@lang('index.failed_to_load_backup_details')">

    <section class="main-content-wrapper">
        @include('utilities.messages')
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header">{{ isset($title) && $title ? $title : '' }}</h2>
                    <input type="hidden" class="datatable_name" data-title="{{ isset($title) && $title ? $title : '' }}"
                        data-id_name="datatable">
                </div>
                @if (routePermission('create-backup'))
                    <div class="col-md-6 justify-content-end">
                        <button type="button" class="btn bg-blue-btn" id="createBackupBtn">
                            <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                            @lang('index.create_backup')
                        </button>
                    </div>
                @endif

            </div>
        </section>

        <!-- Progress Bar for Backup/Restore -->
        <div id="progressContainer" style="display: none; margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-wrapper">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: 0%; background-color: {{ $base_color }};" id="progressBar">
                                <span id="progressText">0%</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <span id="progressMessage">Initializing...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-wrapper">
            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="width_1_p">@lang('index.sn')</th>
                                <th class="width_15_p">@lang('index.filename')</th>
                                <th class="width_10_p">@lang('index.file_size')</th>
                                <th class="width_10_p">@lang('index.date')</th>
                                <th class="width_10_p">@lang('index.time')</th>
                                <th class="width_10_p">@lang('index.created_at')</th>
                                <th class="width_3_p ir_txt_center">@lang('index.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($backups && !empty($backups))
                                <?php
                                $i = count($backups);
                                ?>
                            @endif
                            @foreach ($backups as $backup)
                                <tr>
                                    <td class="c_center">{{ $i-- }}</td>
                                    <td>{{ $backup['filename'] }}</td>
                                    <td>{{ $backup['size'] }}</td>
                                    <td>{{ $backup['date'] }}</td>
                                    <td>{{ $backup['time'] }}</td>
                                    <td>{{ $backup['created_at'] }}</td>
                                    <td class="ir_txt_center">
                                        @if (routePermission('restore-backup'))
                                            <button class="btn btn-warning btn-sm restore-backup"
                                                data-filename="{{ $backup['filename'] }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="@lang('index.restore_backup')">
                                                <i class="fa fa-refresh tiny-icon"></i>
                                            </button>
                                        @endif
                                        @if (routePermission('delete-backup'))
                                            <button class="btn btn-danger btn-sm delete-backup"
                                                data-filename="{{ $backup['filename'] }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="@lang('index.delete')">
                                                <i class="fa fa-trash tiny-icon"></i>
                                            </button>
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
    <script src="{!! $baseURL . 'frequent_changing/js/backup.js' !!}"></script>
@endsection
