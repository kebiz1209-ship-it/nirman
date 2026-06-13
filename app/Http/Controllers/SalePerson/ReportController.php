<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function index()
    {
        return view('pages.sale-person.reports.index');
    }

}