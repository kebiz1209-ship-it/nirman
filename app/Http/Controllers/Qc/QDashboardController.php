<?php

namespace App\Http\Controllers\Qc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QDashboardController extends Controller
{
    public function index()
    {
        return view('pages.qc.dashboard');
    }
}