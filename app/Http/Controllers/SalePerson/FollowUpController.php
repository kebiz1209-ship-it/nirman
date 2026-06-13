<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class FollowUpController extends Controller
{

    public function index()
    {
        return view('pages.sale-person.follow-up.index');
    }

    public function create()
{
    return view('pages.sale-person.follow-up.create');
}

}