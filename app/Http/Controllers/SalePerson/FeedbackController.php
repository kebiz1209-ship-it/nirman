<?php

namespace App\Http\Controllers\SalePerson;

use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('pages.sale-person.feedback.index');
    }

    public function create()
{
    return view('pages.sale-person.feedback.create');
}
}