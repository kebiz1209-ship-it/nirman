<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('pages.sale-person.Orders.index');
    }

       public function create()
    {
        return view('pages.sale-person.Orders.create');
    }
       public function addProduct()
    {
        return view('pages.sale-person.product.create');
    }
}
