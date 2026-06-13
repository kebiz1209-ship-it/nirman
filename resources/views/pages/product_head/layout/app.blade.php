@php
    $baseURL = getBaseURL();
    $setting = getSettingsInfo();
    $whiteLabelInfo = getWhiteLabelInfo();
    $base_color = '#6ab04c';
    if (isset($setting->base_color) && $setting->base_color) {
        $base_color = $setting->base_color;
    }
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ isset($whiteLabelInfo->site_title) ? $whiteLabelInfo->site_title : config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/bower_components/select2/dist/css/select2.min.css?v=1.3' !!}">

    <link rel="stylesheet" href="{!! $baseURL . 'assets/plugins/iCheck/all.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'assets/customCSS/custom.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/css/custom_css.css?v=1.3' !!}">


    <link rel="stylesheet" href="{!! $baseURL . 'assets/bower_components/sweetalert2/dist/sweetalert.min.css?v=1.3' !!}">

    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/bower_components/datepicker/datepicker.css?v=1.3' !!}">


    <!-- Bootstrap 5.0.0 -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/bower_components/bootstrap-new/bootstrap.min.css?v=1.3' !!}">

    <!-- New Admin Panel Design -->
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/newDesign/style_v1.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/css/responsive_v1.css?v=1.3' !!}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/bower_components/font-awesome/css/all.min.css?v=1.3' !!}">

    <link rel="stylesheet" href="{!! $baseURL . 'assets/dist/css/jquery.mCustomScrollbar.css?v=1.3' !!}">

    <link rel="stylesheet" href="{!! $baseURL . 'assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.css?v=1.3' !!}">


    <!-- Favicon -->
    <link rel="shortcut icon" href="{!! $baseURL .
        (isset($whiteLabelInfo->favicon)
            ? 'uploads/white_label/' . $whiteLabelInfo->favicon
            : 'assets/branding/favicon.ico') !!}" type="image/x-icon">

    <!-- Theme style -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/dist/css/AdminLTE.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'assets/dist/css/common.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'assets/plugins/nice-select/css/nice-select.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/css/preloader.css?v=1.3' !!}">

    <!-- Google Font -->
    <link rel="stylesheet" href="{!! $baseURL . 'assets/plugins/local/google_font.css?v=1.3' !!}">
    <link rel="stylesheet" href="{!! $baseURL . 'frequent_changing/css/custom_tooltip.css?v=1.3' !!}">
    <style>
        .buy-now {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
    box-shadow: 0 1px 20px 1px rgb(234, 84, 85) !important;
    position: fixed;
    z-index: 999;
    inset-block-end: 8%;
    inset-inline-end: 35px;
    padding: 11px;
    font-weight: bold;
}
    </style>
    @stack('styles')
</head>

@php
    $is_collapse = session('is_collapse') ?? 'No';
@endphp
<div class="loader"></div>

<body
    class="hold-transition skin-blue sidebar-mini {{ isset($is_collapse) && $is_collapse == 'No' ? '' : 'sidebar-collapse' }}">
    <input type="hidden" name="datatable_showing" id="datatable_showing" value="@lang('index.showing')">
    <input type="hidden" name="Showing_to" id="Showing_to" value="@lang('index.to')">
    <input type="hidden" name="Showing_from" id="Showing_from" value="@lang('index.from')">
    <input type="hidden" name="Showing_entries" id="Showing_entries" value="@lang('index.entries')">
    <input type="hidden" name="First" id="show_First" value="@lang('index.first')">
    <input type="hidden" name="Last" id="show_Last" value="@lang('index.last')">
    <input type="hidden" name="Next" id="show_Next" value="@lang('index.next')">
    <input type="hidden" name="Prev" id="show_Prev" value="@lang('index.prev')">
    <input type="hidden" name="no_data_in_table" id="no_data_in_table" value="@lang('index.no_data_in_table')">
    <input type="hidden" name="no_match_data_in_table" id="no_match_data_in_table" value="@lang('index.no_match_data')">
    <input type="hidden" id="default_currency" value="{{ $setting->currency }}" />
    <input type="hidden" name="hidden_currency" class="hidden_currency" id="hidden_currency"
        value="{{ $setting->currency }}">
    <input type="hidden" name="hidden_base_url" class="hidden_base_url" id="hidden_base_url"
        value="{{ getBaseURL() }}">
    <input type="hidden" id="thischaracterisnotallowed" class="thischaracterisnotallowed"
        value="@lang('index.this_character_is_not_allowed')">
    <input type="hidden" name="hidden_alert" id="hidden_alert" class="hidden_alert" value="@lang('index.alert')">
    <input type="hidden" name="hidden_ok" id="hidden_ok" class="hidden_ok" value="@lang('index.ok')">
    <input type="hidden" name="hidden_cancel" id="hidden_cancel" class="hidden_cancel" value="@lang('index.cancel')">
    <input type="hidden" name="are_you_sure" id="are_you_sure" class="are_you_sure" value="@lang('index.are_you_sure')">
    <input type="hidden" id="file_size_required" value="@lang('index.please_select_less_than_5mb_file')">
    <input type="hidden" id="file_size_required_1" value="@lang('index.please_select_less_than_1mb_file')">
    <input type="hidden" id="file_size_required_2" value="@lang('index.please_select_less_than_2mb_file')">
    <input type="hidden" id="file_size_required_3" value="@lang('index.please_select_less_than_3mb_file')">
    <input type="hidden" id="file_size_required_4" value="@lang('index.please_select_less_than_4mb_file')">
    <input type="hidden" id="file_size_required_5" value="@lang('index.please_select_less_than_5mb_file')">
    <input type="hidden" id="file_size_required_6" value="@lang('index.please_select_less_than_6mb_file')">
    <input type="hidden" id="file_size_required_7" value="@lang('index.please_select_less_than_7mb_file')">
    <input type="hidden" id="print_db" value="@lang('index.print_db')">
    <input type="hidden" id="excel_db" value="@lang('index.excel_db')">
    <input type="hidden" id="pdf_db" value="@lang('index.pdf_db')">

    @php
        $language = '';
    @endphp

    <div class="main-preloader">
        <div class="loadingio-spinner-spin-nq4q5u6dq7r">
            <div class="ldio-x2uulkbinbj">
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper <?= isArabic() ? 'arabic-lang"' : '' ?>">

        <header class="main-header" dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
            @include('layouts.topbar')
        </header>

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar <?= isArabic() ? 'main-sidebar2' : '' ?>">
            @include('pages.product_head.layout.sidebar')
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="sidebar_sub_menu">
            </div>
            @yield('script_top')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="footer-inner-area">
                <p>
                    {{ isset($whiteLabelInfo->footer) ? $whiteLabelInfo->footer : config('app.name') }}.
                    @lang('index.developed_by')
                    <a class="text-decoration-none site-color footer_link" target="_blank"
                        href="{{ $whiteLabelInfo->company_website }}">{{ $whiteLabelInfo->company_name }}</a>
                    <span class="footer_version">Version 1.3</span>
                </p>
            </div>
        </footer>

        @if(appMode() == 'demo')
            <a href="https://codecanyon.net/item/iproduction-production-and-manufacture-management-software/54974177" target="_blank" class="btn buy-now"><iconify-icon icon="solar:cart-large-broken" width="18" class="me-2"></iconify-icon> Buy Now</a>
        @endif
    </div>
    <!-- jQuery 3 -->
    <script src="{!! $baseURL . 'assets/bower_components/jquery/dist/jquery.min.js?v=1.3' !!}"></script>

    <!-- Select2 -->
    <script src="{!! $baseURL . 'assets/bower_components/select2/dist/js/select2.full.min.js?v=1.3' !!}"></script>
    <!-- Bootstrap 5.0.0 -->
    <script src="{!! $baseURL . 'assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'assets/bower_components/bootstrap-new/bootstrap.bundle.min.js?v=1.3' !!}"></script>
    @stack('top_script')
    <!-- iCheck -->
    <script src="{!! $baseURL . 'assets/plugins/iCheck/icheck.min.js?v=1.3' !!}"></script>
    <!-- bootstrap datepicker -->
    <script src="{!! $baseURL . 'assets/bower_components/datepicker/bootstrap-datepicker.js?v=1.3' !!}"></script>

    <script src="{!! $baseURL . 'frequent_changing/js/iconify-icon.min.js?v=1.3' !!}"></script>
    <!-- Sweet alert -->
    <script src="{!! $baseURL . 'assets/bower_components/sweetalert2/dist/sweetalert.min.js?v=1.3' !!}"></script>
    <!-- FastClick -->
    <script src="{!! $baseURL . 'assets/bower_components/fastclick/lib/fastclick.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'assets/plugins/nice-select/js/jquery.nice-select.min.js?v=1.3' !!}"></script>
    <!-- AdminLTE App -->
    <script src="{!! $baseURL . 'assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js?v=1.3' !!}"></script>

    <script src="{!! $baseURL . 'assets/dist/js/adminlte.min.js?v=1.3' !!}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{!! $baseURL . 'assets/dist/js/demo.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'assets/dist/js/menu.js?v=1.3' !!}"></script>

    <script type="text/javascript" src="{!! $baseURL . 'assets/js/jquery.cookie.js?v=1.3' !!}"></script>
    <!-- custom scrollbar plugin -->
    <script src="{!! $baseURL . 'assets/dist/js/jquery.mCustomScrollbar.concat.min.js?v=1.3' !!}"></script>

    <!-- material icon -->


    <!-- ADD THIS BEFORE </body> -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{!! $baseURL . 'assets/dist/js/feather.min.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/js/user_home_buttom1222021v1.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/js/user_home.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/newDesign/js/new-script.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/js/common_script.js?v=1.3' !!}"></script>
    <script src="{!! $baseURL . 'frequent_changing/js/custom.js?v=1.3' !!}"></script>
    @yield('script')
</body>

</html>
