@extends('pages.product_head.layout.app')

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
                <h3 class="top-left-header mb-0">Manufacturing Dashboard</h3>
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

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-indigo">
                <div class="kpi-inner">
                    <span class="kpi-label">New Requests</span>
                    <h3 class="kpi-value">12</h3>
                    <span class="kpi-sub">3 scheduled for today</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:phone-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-rose">
                <div class="kpi-inner">
                    <span class="kpi-label">Pending Reviews</span>
                    <h3 class="kpi-value">8</h3>
                    <span class="kpi-sub">2 high priority</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-amber">
                <div class="kpi-inner">
                    <span class="kpi-label">Query Raised</span>
                    <h3 class="kpi-value">5</h3>
                    <span class="kpi-sub">Awaiting approval</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:document-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-emerald">
                <div class="kpi-inner">
                    <span class="kpi-label">Awaiting Customer Response</span>
                    <h3 class="kpi-value">4</h3>
                    <span class="kpi-sub">1 urgent query</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:factory-broken"></iconify-icon>
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

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-violet">
                <div class="kpi-inner">
                    <span class="kpi-label">Approved Orders</span>
                    <h3 class="kpi-value">6</h3>
                    <span class="kpi-sub">2 dispatch today</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:box-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-cyan">
                <div class="kpi-inner">
                    <span class="kpi-label">Rejected Orders</span>
                    <h3 class="kpi-value">10</h3>
                    <span class="kpi-sub">₹8.5L total value</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:document-add-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-orange">
                <div class="kpi-inner">
                    <span class="kpi-label">Sample Development</span>
                    <h3 class="kpi-value">3</h3>
                    <span class="kpi-sub">Expected tomorrow</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:delivery-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-teal">
                <div class="kpi-inner">
                    <span class="kpi-label">Production Planning Pending</span>
                    <h3 class="kpi-value">7</h3>
                    <span class="kpi-sub">₹2.1L outstanding</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:card-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Section Label ── -->
    <!-- <div class="dash-section-title" style="margin-top:6px;">
        <iconify-icon icon="solar:chart-broken" style="font-size:14px;"></iconify-icon>
        Activity & Alerts
    </div> -->

    <!-- KPI ROW 3 : Activity -->
    <!-- <div class="row">

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-emerald">
                <div class="kpi-inner">
                    <span class="kpi-label">Collection This Month</span>
                    <h3 class="kpi-value">₹11.1L</h3>
                    <span class="kpi-sub">7 payments received</span>
                    <div class="progress-track" style="margin-top:8px; max-width:140px;">
                        <div class="progress-fill"
                            style="width:55%; background: linear-gradient(90deg,#10b981,#059669);"></div>
                    </div>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:wallet-money-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-sky">
                <div class="kpi-inner">
                    <span class="kpi-label">Feedback Pending</span>
                    <h3 class="kpi-value">9</h3>
                    <span class="kpi-sub">3 overdue responses</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:chat-round-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-rose">
                <div class="kpi-inner">
                    <span class="kpi-label">Overdue Pending</span>
                    <h3 class="kpi-value">₹3.4L</h3>
                    <span class="kpi-sub">5 accounts overdue</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:danger-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-amber">
                <div class="kpi-inner">
                    <span class="kpi-label">Customer Complaints</span>
                    <h3 class="kpi-value">2</h3>
                    <span class="kpi-sub">1 escalated</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:bell-bing-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="kpi-card kpi-violet">
                <div class="kpi-inner">
                    <span class="kpi-label">Repeat Orders</span>
                    <h3 class="kpi-value">₹11.1L</h3>
                    <span class="kpi-sub">7 returning customers</span>
                </div>
                <div class="kpi-icon-wrap">
                    <div class="kpi-icon">
                        <iconify-icon icon="solar:refresh-broken"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

    </div> -->

    <!-- ── CHART ── -->
    <div class="row grap-row">
        <div class="col-xl-12">
            <div class="chart-card">

                <div class="chart-card-header">
                    <h3 class="chart-card-title">
                        <iconify-icon icon="solar:chart-broken"></iconify-icon>
                        Money Flow Comparison
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
        <iconify-icon icon="solar:clipboard-list-broken"></iconify-icon>
        Order Processing Summary
    </h3>
</div>

             <div class="collection-grid">

    <div class="collection-tile">
        <span class="tile-label">Orders Received</span>
        <div class="tile-value">52</div>
        <span class="tile-sub">Current Month</span>
    </div>

    <div class="collection-tile">
        <span class="tile-label">Under Evaluation</span>
        <div class="tile-value">12</div>
        <span class="tile-sub">Technical Review</span>
    </div>

    <div class="collection-tile">
        <span class="tile-label">Approved</span>
        <div class="tile-value">30</div>
        <span class="tile-sub">Ready for Production</span>
    </div>

    <div class="collection-tile">
        <span class="tile-label">Completed</span>
        <div class="tile-value">22</div>
        <span class="tile-sub">Successfully Closed</span>
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

        <!-- Production Planning Queue -->
        <div class="col-md-6">
            <div class="panel-card">

                <div class="panel-header">
                    <h3>
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                       Production Planning Queue
                    </h3>
                </div>

                <table class="dash-table">
                   <thead>
<tr>
    <th>Customer</th>
    <th>Order No.</th>
    <th>Stage</th>
</tr>
</thead>

<tbody>

<tr>
    <td>ABC Chemicals</td>
    <td>ORD-2201</td>
    <td>
        <span class="status-badge badge-in-process">
            Technical Evaluation
        </span>
    </td>
</tr>

<tr>
    <td>XYZ Industries</td>
    <td>ORD-2202</td>
    <td>
        <span class="status-badge badge-dispatch">
            Approval Pending
        </span>
    </td>
</tr>

<tr>
    <td>Prime Hygiene</td>
    <td>ORD-2203</td>
    <td>
        <span class="status-badge badge-success">
            Production Planned
        </span>
    </td>
</tr>

<tr>
    <td>Global Pharma</td>
    <td>ORD-2204</td>
    <td>
        <span class="status-badge badge-warning">
            Customer Clarification
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