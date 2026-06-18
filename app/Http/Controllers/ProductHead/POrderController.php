<?php

namespace App\Http\Controllers\ProductHead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class POrderController extends Controller
{

    public function orders()
    {
        return view('pages.product_head.orders.index');
    }

    public function createOrder()
{
    return view('pages.product_head.orders.create');
}

    public function viewOrder()
{
    return view('pages.product_head.orders.view');
}

    public function infoReview()
{
    return view('pages.product_head.orders.info-review');
}



  public function boq()
    {
        return view('pages.product_head.boq.index');
    }

      public function createBoq()
    {
        return view('pages.product_head.boq.create');
    }



}