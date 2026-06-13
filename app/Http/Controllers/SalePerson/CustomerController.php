<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.sale-person.customer.index');
    }
       public function create()
    {
        return view('pages.sale-person.customer.create');
    }
}