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
}