<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.index');
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request) { }

    public function show($id) {
        return view('pages.products.show');
     }

    public function edit($id) { }

    public function update(Request $request, $id) { }

    public function destroy($id) { }
}