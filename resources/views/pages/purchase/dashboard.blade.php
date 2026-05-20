@extends('layouts.app')

@section('content')

<style>
    .dashboard-switcher {
        max-width: 350px;
        margin: 30px auto;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .dashboard-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
    }

    .dashboard-select {
        width: 100%;
        height: 50px;
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        padding: 0 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        background-color: #f9fafc;
    }

    .dashboard-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78,115,223,.25);
        outline: none;
        background: #fff;
    }
</style>

<div class="container">
    <div class="dashboard-switcher">
        <div class="dashboard-card">

            <div class="dashboard-title">
                Select Dashboard
            </div>

            <select class="form-control dashboard-select select2"
                onchange="if(this.value) window.location.href=this.value">

                <option value="">
                    Select Dashboard
                </option>

                {{-- Main Dashboard --}}
                <option value="{{ route('dashboard') }}"
                    {{ request()->routeIs('dashboard') ? 'selected' : '' }}>
                    Main Dashboard
                </option>

                {{-- Order Dashboard --}}
                @if(routePermission('customer_order.dashboard'))
                <option value="{{ route('customer_order.dashboard') }}"
                    {{ request()->routeIs('customer_order.dashboard') ? 'selected' : '' }}>
                    Order Dashboard
                </option>
                @endif

                {{-- Sales Dashboard --}}
                @if(routePermission('sales.dashboard'))
                <option value="{{ route('sales.dashboard') }}"
                    {{ request()->routeIs('sales.dashboard') ? 'selected' : '' }}>
                    Sales Dashboard
                </option>
                @endif

                {{-- Purchase Dashboard --}}
                @if(routePermission('purchase.dashboard'))
                <option value="{{ route('purchase.dashboard') }}"
                    {{ request()->routeIs('purchase.dashboard') ? 'selected' : '' }}>
                    Purchase Dashboard
                </option>
                @endif

                {{-- Production Dashboard --}}
                @if(routePermission('production.dashboard'))
                <option value="{{ route('production.dashboard') }}"
                    {{ request()->routeIs('production.dashboard') ? 'selected' : '' }}>
                    Production Dashboard
                </option>
                @endif

                {{-- Stock Dashboard --}}
                @if(routePermission('stock.dashboard'))
                <option value="{{ route('stock.dashboard') }}"
                    {{ request()->routeIs('stock.dashboard') ? 'selected' : '' }}>
                    Stock Dashboard
                </option>
                @endif

            </select>

        </div>
    </div>
</div>

@endsection