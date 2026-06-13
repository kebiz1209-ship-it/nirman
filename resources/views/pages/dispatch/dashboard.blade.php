@extends('pages.dispatch.layout.app')

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
                <h3 class="top-left-header mb-0">Dispatch/logistic</h3>
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
    <div class="row">

        <!-- Dispatch Orders -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-indigo">
                <div class="kpi-inner">
                    <span class="kpi-label">Dispatch Orders</span>
                    <h3 class="kpi-value">24</h3>
                    <span class="kpi-sub">Ready for dispatch</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:box-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipment Planning -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-emerald">
                <div class="kpi-inner">
                    <span class="kpi-label">Shipment Planning</span>
                    <h3 class="kpi-value">12</h3>
                    <span class="kpi-sub">Pending scheduling</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:route-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Management -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-amber">
                <div class="kpi-inner">
                    <span class="kpi-label">Vehicles Available</span>
                    <h3 class="kpi-value">8</h3>
                    <span class="kpi-sub">Ready for loading</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:bus-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tracking -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-rose">
                <div class="kpi-inner">
                    <span class="kpi-label">In Transit</span>
                    <h3 class="kpi-value">18</h3>
                    <span class="kpi-sub">Currently moving</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:map-point-broken"></iconify-icon>
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

    <!-- KPI ROW 2 : Orders / Payments -->
    <div class="row">

        <!-- Delivery Confirmation -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-violet">
                <div class="kpi-inner">
                    <span class="kpi-label">Delivered Today</span>
                    <h3 class="kpi-value">15</h3>
                    <span class="kpi-sub">Confirmed deliveries</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending POD -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-cyan">
                <div class="kpi-inner">
                    <span class="kpi-label">Pending POD</span>
                    <h3 class="kpi-value">7</h3>
                    <span class="kpi-sub">Awaiting confirmation</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:file-check-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delayed Shipments -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-orange">
                <div class="kpi-inner">
                    <span class="kpi-label">Delayed Shipments</span>
                    <h3 class="kpi-value">3</h3>
                    <span class="kpi-sub">Need attention</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:danger-triangle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="kpi-card kpi-teal">
                <div class="kpi-inner">
                    <span class="kpi-label">Monthly Reports</span>
                    <h3 class="kpi-value">5</h3>
                    <span class="kpi-sub">Generated this month</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:chart-square-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ── CHART ── -->
    
    <!-- ── LOWER PANELS ── -->
    <div class="row mt-2">

        <!-- Dispatch Summary-->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:wallet-money-broken"></iconify-icon>
                        Dispatch Summary
                    </h3>
                </div>

                <div class="collection-grid">
                    <div class="collection-tile">
                        <span class="tile-label">Total Dispatches</span>
                        <div class="tile-value" style="color:#10b981;">₹1,20,000</div>
                        <span class="tile-sub">Collected</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">Delivered</span>
                        <div class="tile-value" style="color:#f59e0b;">₹35,000</div>
                        <span class="tile-sub">Awaiting</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">In Transit</span>
                        <div class="tile-value" style="color:#6366f1;">18</div>
                        <span class="tile-sub">Received</span>
                    </div>
                    <div class="collection-tile">
                        <span class="tile-label">Pending</span>
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

        <!-- Running Customer Orders -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                        Running Customer Orders
                    </h3>
                </div>

                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Dispatch No .</th>
                            <th>Vehicle </th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:9px;">
                                    <div
                                        style="width:30px; height:30px; border-radius:8px; background:#d1fae5; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#065f46; flex-shrink:0;">
                                        AC</div>
                                    ABC Chemicals
                                </div>
                            </td>
                            <td style="color:#6b7280;">ORD-2201</td>
                            <td style="color:#6b7280;">UP16EF9876 </td>
                            <td><span class="status-badge badge-in-process">In Process</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:9px;">
                                    <div
                                        style="width:30px; height:30px; border-radius:8px; background:#fef3c7; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#92400e; flex-shrink:0;">
                                        XI</div>
                                    XYZ Industries
                                </div>
                            </td>
                            <td style="color:#6b7280;">ORD-2202</td>
                            <td style="color:#6b7280;">UP16EF9876 </td>
                            <td><span class="status-badge badge-dispatch">Dispatch Pending</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display:flex; align-items:center; gap:9px;">
                                    <div
                                        style="width:30px; height:30px; border-radius:8px; background:#fee2e2; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#991b1b; flex-shrink:0;">
                                        PH</div>
                                    Prime Hygiene
                                </div>
                            </td>
                            <td style="color:#6b7280;">ORD-2203</td>
                            <td style="color:#6b7280;">UP16EF9876 </td>
                            <td><span class="status-badge badge-hold">Payment Hold</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</section>

@endsection