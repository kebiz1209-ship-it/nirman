@extends('pages.product_head.layout.app')

@section('content')

<style>
.et-wrap {
    font-size: 13px;
    padding: 1.5rem;
}

.et-topbar {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.25rem;
}

.et-title {
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 3px;
    color: #111;
}

.et-sub {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
}

.et-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: #fff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    color: #374151;
    text-decoration: none;
}

.et-btn:hover {
    background: #f9fafb;
}

.et-filters {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    padding: 12px 14px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.et-filters label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}

.et-filters select {
    width: 100%;
    font-size: 12px;
    height: 32px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 0 8px;
}

.et-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 1rem;
}

.et-order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.et-order-title {
    font-size: 14px;
    font-weight: 600;
    color: #111;
    margin: 0 0 3px;
}

.et-order-meta {
    font-size: 12px;
    color: #6b7280;
    margin: 0;
}

.et-draft-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 9px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: #f3f4f6;
    color: #6b7280;
}

.et-col-header {
    display: grid;
    grid-template-columns: 2fr 1.4fr 2fr;
    gap: 12px;
    padding: 8px 16px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.et-col-header span {
    font-size: 11px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.et-row {
    display: grid;
    grid-template-columns: 2fr 1.4fr 2fr;
    gap: 12px;
    align-items: start;
    padding: 12px 16px;
    border-bottom: 1px solid #f3f4f6;
}

.et-row:last-child {
    border-bottom: none;
}

.et-row:hover {
    background: #fafafa;
}

.act-cell {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}

.row-num {
    font-size: 11px;
    color: #9ca3af;
    min-width: 18px;
    padding-top: 2px;
}

.act-name {
    font-size: 13px;
    font-weight: 600;
    color: #111;
    margin: 0 0 5px;
}

.act-meta {
    font-size: 11px;
    color: #6b7280;
    margin: 2px 0;
}

.priority-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    margin-top: 4px;
}

.p-high {
    background: #fef3c7;
    color: #92400e;
}

.p-critical {
    background: #fee2e2;
    color: #991b1b;
}

.p-normal {
    background: #dbeafe;
    color: #1e40af;
}

.et-col select,
.et-col input[type="text"] {
    width: 100%;
    font-size: 12px;
    height: 32px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 0 8px;
    color: #111;
}

.et-col input[type="text"] {
    height: 32px;
}

.et-save-bar {
    display: flex;
    justify-content: flex-end;
    padding-top: 0.5rem;
}

.et-save-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    background: #d1fae5;
    border: 1px solid #6ee7b7;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #065f46;
    cursor: pointer;
}

.et-save-btn:hover {
    background: #a7f3d0;
}
</style>

<div class="et-wrap" style="margin-left: 20px;">

    <div class="et-topbar">
        <div>
            <p class="et-title">Execution tracker</p>
            <p class="et-sub">Update status and raise alerts for planned activities</p>
        </div>
        <a href="{{ route('pages.production.order') }}" class="et-btn">
            <i class="fa fa-arrow-left" style="font-size:12px;"></i> Back
        </a>
    </div>

    <div class="et-filters">
        <div>
            <label>Order</label>
            <select>
                <option>All orders</option>
            </select>
        </div>
        <div>
            <label>Status</label>
            <select>
                <option>All statuses</option>
                <option>Pending</option>
                <option>In progress</option>
                <option>Completed</option>
                <option>Delayed</option>
            </select>
        </div>
    </div>

    <div class="et-card">

        <div class="et-order-header">
            <div>
                <p class="et-order-title">ORD-001 — Kashish Amulani</p>
                <p class="et-order-meta">Handover: — &nbsp;·&nbsp; Dispatch: — &nbsp;·&nbsp; 15 activities</p>
            </div>
            <!-- <span class="et-draft-badge">
                <i class="fa fa-pencil" style="font-size:11px;"></i> Draft
            </span> -->
        </div>

        <div class="et-col-header">
            <span>Activity</span>
            <span>Status</span>
            <span>Note</span>
        </div>

        @php
        $activities = [
        ['Order review & info clarity', 'High'],
        ['BOQ preparation', 'High'],
        ['Raw material arrangement', 'High'],
        ['Technical data sheet preparation', 'Normal'],
        ['Packaging instructions finalization', 'Normal'],
        ['Raw material weighing & sieving', 'High'],
        ['Technical mixing', 'Critical'],
        ['QC — microbial contamination check', 'Critical'],
        ['QC — CFU count verification', 'Critical'],
        ['Secondary packaging', 'Normal'],
        ['Tertiary packaging & labelling', 'Normal'],
        ['Packaging integrity verification', 'High'],
        ['Invoicing & document preparation', 'Normal'],
        ['Transport booking & logistics', 'Normal'],
        ['Handover to carrier', 'High'],
        ];
        @endphp

        @foreach($activities as $i => $activity)
        <div class="et-row">

            <div class="act-cell">
                <span class="row-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <div>
                    <p class="act-name">{{ $activity[0] }}</p>
                 <p class="act-meta"><i class="fa fa-user" style="font-size:11px;"></i> Admin</p>
<p class="act-meta"><i class="fa fa-calendar" style="font-size:11px;"></i> 18 Jun 2026 → 25 Jun 2026</p>
                    <span class="priority-pill
                        @if($activity[1] == 'High') p-high
                        @elseif($activity[1] == 'Critical') p-critical
                        @else p-normal
                        @endif">
                        {{ $activity[1] }}
                    </span>
                </div>
            </div>

            <div class="et-col">
                <select>
                    <option value="">— Set status —</option>
                    <option>Pending</option>
                    <option>In progress</option>
                    <option>Completed</option>
                    <option>Delayed</option>
                    <option>Hold</option>
                </select>
            </div>

            <div class="et-col">
                <input type="text" placeholder="Add a note...">
            </div>

        </div>
        @endforeach

    </div>

    <div class="et-save-bar">
        <button class="et-save-btn">
            <i class="fa fa-save"></i> Save updates
        </button>
    </div>

</div>

@endsection