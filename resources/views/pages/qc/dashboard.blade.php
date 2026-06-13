@extends('pages.qc.layout.app')

@section('content')
@php
$baseURL = getBaseURL();
$setting = getSettingsInfo();
$base_color = '#6ab04c';

if (isset($setting->base_color) && $setting->base_color) {
$base_color = $setting->base_color;
}

// Dummy Graph Data
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
$sales = [120000, 145000, 132000, 170000, 155000, 190000];
$collection = [95000, 110000, 125000, 138000, 149000, 165000];
@endphp

<link rel="stylesheet" href="{{ url('public/assets/dist/css/custom/dashboard.css') }}">
<link rel="stylesheet" href="{{ url('public/modules/common/dashboard.css') }}">


<!-- ════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════ -->
<section class="main-content-wrapper dashboard-wrapper">

    @include('utilities.messages')

    <!-- Page Header -->
    <section class="content-header dashboard_content_header my-2">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h3 class="top-left-header mb-0">Quality Check Dashboard</h3>
                <p style="font-size:12.5px; color:#9ca3af; margin:2px 0 0 1px;">
                    {{ date('l, d F Y') }} &nbsp;·&nbsp; 
                </p>
            </div>
        </div>
    </section>

    <!-- ── Section Label ── -->
    <div class="dash-section-title">
        <iconify-icon icon="solar:bell-bing-broken" style="font-size:14px;"></iconify-icon>
        Today's Actions
    </div>


    <!-- KPI ROW 1 : Action items -->
    <div class="row">

        <!-- Pending QC -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-indigo">
                <div class="kpi-inner">
                    <span class="kpi-label">Pending QC</span>
                    <h3 class="kpi-value">12</h3>
                    <span class="kpi-sub">Awaiting inspection</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:clipboard-check-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved Batches -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-emerald">
                <div class="kpi-inner">
                    <span class="kpi-label">Approved Batches</span>
                    <h3 class="kpi-value">8</h3>
                    <span class="kpi-sub">Passed quality check</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected Batches -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-rose">
                <div class="kpi-inner">
                    <span class="kpi-label">Rejected Batches</span>
                    <h3 class="kpi-value">5</h3>
                    <span class="kpi-sub">Failed inspection</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:close-circle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Retest Required -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-amber">
                <div class="kpi-inner">
                    <span class="kpi-label">Retest Required</span>
                    <h3 class="kpi-value">4</h3>
                    <span class="kpi-sub">Need re-verification</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:refresh-circle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Section Label ── -->
    <!-- <div class="dash-section-title" style="margin-top:6px;">
        <iconify-icon icon="solar:bag-broken" style="font-size:14px;"></iconify-icon>
        Orders & Payments
    </div> -->


    <!-- KPI ROW 2 -->
    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-violet">
                <div class="kpi-inner">
                    <span class="kpi-label">COA Pending</span>
                    <h3 class="kpi-value">6</h3>
                    <span class="kpi-sub">Certificate generation</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:document-text-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ── CHART ── -->


    <!-- ── LOWER PANELS ── -->
    <div class="row mt-2">

        <!-- Collection Summary -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:wallet-money-broken"></iconify-icon>
                        Quality Summary
                    </h3>
                </div>

                <div class="collection-grid">

                    <div class="collection-tile">
                        <span class="tile-label">Samples Tested</span>
                        <div class="tile-value" style="color:#10b981;">128</div>
                        <span class="tile-sub">This Month</span>
                    </div>

                    <div class="collection-tile">
                        <span class="tile-label">Approved</span>
                        <div class="tile-value" style="color:#059669;">104</div>
                        <span class="tile-sub">Passed QC</span>
                    </div>

                    <div class="collection-tile">
                        <span class="tile-label">Rejected</span>
                        <div class="tile-value" style="color:#ef4444;">12</div>
                        <span class="tile-sub">Failed QC</span>
                    </div>

                    <div class="collection-tile">
                        <span class="tile-label">Retest</span>
                        <div class="tile-value" style="color:#f59e0b;">12</div>
                        <span class="tile-sub">Pending</span>
                    </div>

                </div>

                <!-- Target progress -->
                <div style="padding:16px 18px 18px;">
                    <div
                        style="display:flex; justify-content:space-between; font-size:11.5px; color:#9ca3af; margin-bottom:6px;">
                        <span style="font-weight:600;">Target Progress</span>
                        <span style="font-weight:700; color:#6366f1;">60%</span>
                    </div>
                    <div class="progress-track" style="height:8px;">
                        <div class="progress-fill" style="width:60%;"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Recent QC Activities -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                        Recent QC Activities
                    </h3>
                </div>

                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Batch No.</th>
                            <th>Product</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>BT-2401</td>
                            <td>Liquid Cleaner</td>
                            <td>
                                <span class="status-badge badge-success">
                                    Approved
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-2402</td>
                            <td>Hand Wash</td>
                            <td>
                                <span class="status-badge badge-hold">
                                    Rejected
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-2403</td>
                            <td>Floor Cleaner</td>
                            <td>
                                <span class="status-badge badge-in-process">
                                    Under Testing
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-2404</td>
                            <td>Dish Wash</td>
                            <td>
                                <span class="status-badge badge-dispatch">
                                    COA Pending
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

</section>

@endsection