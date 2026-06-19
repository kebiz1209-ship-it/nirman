@extends('pages.production.layout.app')

@section('content')

<style>
.po-wrap { padding: 1.5rem; }
.po-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; }
.po-title { font-size: 20px; font-weight: 600; margin: 0; color: #111; }
.po-subtitle { font-size: 13px; color: #6b7280; margin: 4px 0 0; }
.po-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
.po-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.po-table thead tr { background: #f9fafb; }
.po-table th { padding: 10px 14px; text-align: left; font-weight: 600; font-size: 11px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb; white-space: nowrap; }
.po-table td { padding: 13px 14px; color: #111827; border-bottom: 1px solid #f3f4f6; vertical-align: middle; white-space: nowrap; }
.po-table tbody tr:last-child td { border-bottom: none; }
.po-table tbody tr { border-left: 3px solid transparent; }
.po-table tbody tr.status-pending { border-left-color: #f59e0b; }
.po-table tbody tr.status-planned { border-left-color: #10b981; }
.po-table tbody tr:hover td { background: #f9fafb; }
.order-no { font-weight: 600; font-family: monospace; font-size: 12px; }
.product-name { color: #6b7280; }
.badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.badge-pending { background: #fef3c7; color: #92400e; }
.badge-planned { background: #d1fae5; color: #065f46; }
.badge-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
.dot-pending { background: #f59e0b; }
.dot-planned { background: #10b981; }
.btn-plan { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #fff; border: 1px solid #d1d5db; border-radius: 8px; font-size: 12px; font-weight: 500; color: #374151; cursor: pointer; text-decoration: none; transition: background 0.15s; }
.btn-plan:hover { background: #f9fafb; color: #374151; text-decoration: none; }
.po-footer { padding: 10px 14px; border-top: 1px solid #e5e7eb; display: flex; align-items: center; gap: 1.25rem; background: #f9fafb; }
.po-footer-stat { font-size: 12px; color: #6b7280; }
.po-footer-stat strong { color: #111827; }
</style>

<div class="po-wrap" style="margin-left:20px;">

    <div class="po-header">
        <div>
            <p class="po-title">Production orders</p>
            <p class="po-subtitle">2 active orders</p>
        </div>
        <!-- <a href="#" class="btn-plan">
            <i class="fa fa-plus"></i> New order
        </a> -->
    </div>

    <div class="po-card">
        <table class="po-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Delivery</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="status-pending">
                    <td style="color:#9ca3af;">1</td>
                    <td><span class="order-no">ORD-001</span></td>
                    <td><strong>ABC Chemicals</strong></td>
                    <td><span class="product-name">Bio Fertilizer</span></td>
                    <td>5,000 KG</td>
                    <td>25 Jun 2026</td>
                    <td>
                        <span class="badge badge-pending">
                            <span class="badge-dot dot-pending"></span>
                            Pending planning
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pages.production.order.planner') }}" class="btn-plan">
                            <i class="fa fa-tasks"></i> Planner
                        </a>
                    </td>
                </tr>
                <tr class="status-planned">
                    <td style="color:#9ca3af;">2</td>
                    <td><span class="order-no">ORD-002</span></td>
                    <td><strong>XYZ Agro</strong></td>
                    <td><span class="product-name">Growth Booster</span></td>
                    <td>2,500 KG</td>
                    <td>28 Jun 2026</td>
                    <td>
                        <span class="badge badge-planned">
                            <span class="badge-dot dot-planned"></span>
                            Planned
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('pages.production.order.planner') }}" class="btn-plan">
                            <i class="fa fa-tasks"></i>Planner
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="po-footer">
            <span class="po-footer-stat"><strong>2</strong> orders total</span>
            <span class="po-footer-stat"><strong>1</strong> pending planning</span>
            <span class="po-footer-stat"><strong>1</strong> planned</span>
        </div>
    </div>

</div>

@endsection