<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
   
  public function index()
{
    $regions = Region::latest()->get();

    return view('pages.regions.index', compact('regions'));
}

public function create()
{
    return view('pages.regions.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:regions,name',
    ]);

    Region::create([
        'name' => $request->name,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('regions.index')
        ->with('success', 'Region created successfully');
}

public function edit(Region $region)
{
    return view('pages.regions.edit', compact('region'));
}

public function update(Request $request, Region $region)
{
    $request->validate([
        'name' => 'required|unique:regions,name,' . $region->id,
    ]);

    $region->update([
        'name' => $request->name,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('regions.index')
        ->with('success', 'Region updated successfully');
}
}