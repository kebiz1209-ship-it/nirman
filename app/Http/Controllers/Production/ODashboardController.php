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
}