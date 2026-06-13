@extends('pages.production.layout.app')

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
                <h3 class="top-left-header mb-0">Production Head</h3>
                <p style="font-size:12.5px; color:#9ca3af; margin:2px 0 0 1px;">
                    {{ date('l, d F Y') }} &nbsp;·&nbsp; Overview of your sales activity
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
<!-- KPI ROW 1 -->
<div class="row">

    <!-- Production Orders -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-indigo">
            <div class="kpi-inner">
                <span class="kpi-label">Today's Production Orders</span>
                <h3 class="kpi-value">12</h3>
                <span class="kpi-sub">3 scheduled for today</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:clipboard-list-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Running Batches -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-cyan">
            <div class="kpi-inner">
                <span class="kpi-label">Running Batches</span>
                <h3 class="kpi-value">8</h3>
                <span class="kpi-sub">2 high priority</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:play-circle-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Batches -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-emerald">
            <div class="kpi-inner">
                <span class="kpi-label">Completed Batches</span>
                <h3 class="kpi-value">5</h3>
                <span class="kpi-sub">Completed today</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Delayed / Rejected -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-rose">
            <div class="kpi-inner">
                <span class="kpi-label">Rejected Batches</span>
                <h3 class="kpi-value">4</h3>
                <span class="kpi-sub">Need attention</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:close-circle-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- KPI ROW 2 -->
<div class="row">

    <!-- Material Requests -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-orange">
            <div class="kpi-inner">
                <span class="kpi-label">Material Requests</span>
                <h3 class="kpi-value">6</h3>
                <span class="kpi-sub">Awaiting issue</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:box-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Material Consumption -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-amber">
            <div class="kpi-inner">
                <span class="kpi-label">Material Consumption</span>
                <h3 class="kpi-value">85%</h3>
                <span class="kpi-sub">This month</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:layers-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Machine Running -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-teal">
            <div class="kpi-inner">
                <span class="kpi-label">Machine Running</span>
                <h3 class="kpi-value">18</h3>
                <span class="kpi-sub">Active machines</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:settings-broken"></iconify-icon>
                </div>
            </div>
        </div>
    </div>

    <!-- Machine Breakdown -->
    <div class="col-lg-3 col-sm-6">
        <div class="kpi-card kpi-red">
            <div class="kpi-inner">
                <span class="kpi-label">Machine Breakdown</span>
                <h3 class="kpi-value">2</h3>
                <span class="kpi-sub">Maintenance required</span>
            </div>
            <div class="kpi-icon-wrap">
                <div class="kpi-icon">
                    <iconify-icon icon="solar:danger-triangle-broken"></iconify-icon>
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



    <!-- ── CHART ── -->
    <div class="row grap-row">
        <div class="col-xl-12">
            <div class="chart-card">

                <div class="chart-card-header">
                    <h3 class="chart-card-title">
                        <iconify-icon icon="solar:chart-broken"></iconify-icon>
                        Production Performance
                        <span style="font-size:12px; font-weight:400; color:#9ca3af; margin-left:4px;">
                            Last 6 months
                        </span>
                    </h3>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#4f46e5;"></span>
                            Sales
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background:#10b981;"></span>
                            Collection
                        </div>
                    </div>
                </div>

                <div class="card-body" style="padding-bottom:20px;">
                    <div class="graph-bars">
                        @foreach($months as $key => $month)
                        @php
                        $salesHeight = $sales[$key] / 1200;
                        $collectionHeight = $collection[$key] / 1200;
                        @endphp
                        <div class="graph-item">
                            <div class="bar-group">
                                <div class="bar sales-bar" style="height:{{ $salesHeight }}px;"
                                    title="{{ $month }} Sales: ₹{{ number_format($sales[$key]) }}"></div>
                                <div class="bar collection-bar" style="height:{{ $collectionHeight }}px;"
                                    title="{{ $month }} Collection: ₹{{ number_format($collection[$key]) }}"></div>
                            </div>
                            <div class="month-label">{{ $month }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ── LOWER PANELS ── -->
    <div class="row mt-2">

        <!-- Collection Summary -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:wallet-money-broken"></iconify-icon>
                        Production Summary
                    </h3>
                </div>

                <div class="collection-grid">
                    <div class="collection-tile">
                        <span class="tile-label">Total Orders</span>
                        <div class="tile-value" style="color:#10b981;">₹1,20,000</div>
                        <span class="tile-sub">Collected</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">Completed</span>
                        <div class="tile-value" style="color:#f59e0b;">₹35,000</div>
                        <span class="tile-sub">Awaiting</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">Orders</span>
                        <div class="tile-value" style="color:#6366f1;">18</div>
                        <span class="tile-sub">Received</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">Target</span>
                        <div class="tile-value" style="color:#374151;">₹2,00,000</div>
                        <span class="tile-sub">Monthly</span>
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

        <!-- Current Batch Status -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                        Current Batch Status
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
                            <td>BT-1001</td>
                            <td>Detergent Powder</td>
                            <td>
                                <span class="status-badge badge-in-process">
                                    Running
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-1002</td>
                            <td>Liquid Cleaner</td>
                            <td>
                                <span class="status-badge badge-dispatch">
                                    Material Pending
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-1003</td>
                            <td>Hand Wash</td>
                            <td>
                                <span class="status-badge badge-success">
                                    Completed
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>BT-1004</td>
                            <td>Floor Cleaner</td>
                            <td>
                                <span class="status-badge badge-hold">
                                    Machine Hold
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