<?php

namespace App\Http\Controllers\Dispatch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DDashboardController extends Controller
{
    public function index()
    {
        return view('pages.dispatch.dashboard');
    }
}