<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class SampleController extends Controller
{

    public function index()
{
    return view('pages.sale-person.samples.index');
}


public function create()
{
    return view('pages.sale-person.samples.create');
}

}