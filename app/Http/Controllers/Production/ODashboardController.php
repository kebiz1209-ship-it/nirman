<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ODashboardController extends Controller
{
    public function index()
    {
        return view('pages.production.dashboard');
    }
    public function order()
    {
        return view('pages.production.order.index');
    }
     public function orderPlan()
    {
        return view('pages.production.order.planner');
    }
}