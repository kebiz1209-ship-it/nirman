<?php

namespace App\Http\Controllers\ProductHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PActivityController extends Controller
{

    public function activity()
    {
        return view('pages.product_head.activity.index');
    }

    public function createActivity()
{
    return view('pages.product_head.activity.create');
}



}