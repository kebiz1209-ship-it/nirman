<?php

namespace App\Http\Controllers\ProductHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDashboardController extends Controller
{
    public function index()
    {
        return view('pages.product_head.dashboard');
    }

    public function orders()
    {
        return view('pages.product_head.orders.index');
    }

    public function createOrder()
{
    return view('pages.product_head.orders.create');
}

    public function productAvailability()
    {
        return view('pages.product_head.product_availability.index');
    }

    public function communicationCenter()
    {
        return view('pages.product_head.communication_center.index');
    }

    public function approvalCenter()
    {
        return view('pages.product_head.approval_center.index');
    }

    public function productionPlanning()
    {
        return view('pages.product_head.production_planning.index');
    }

    public function paymentFollowups()
    {
        return view('pages.product_head.payment_followups.index');
    }

    public function reports()
    {
        return view('pages.product_head.reports.index');
    }
}