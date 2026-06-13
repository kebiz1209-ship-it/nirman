<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{

    public function index()
    {
        return view('pages.sale-person.enquiry.index');
    }


    public function create()
    {
        return view('pages.sale-person.enquiry.create');
    }

}