<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function dashboard()
    {
        return view('pages.sale-person.dashboard');
    }
}