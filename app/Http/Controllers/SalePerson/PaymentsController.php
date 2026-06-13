<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index()
    {

      return view('pages.sale-person.payment.index', ['payments' => collect()]);
    }
}