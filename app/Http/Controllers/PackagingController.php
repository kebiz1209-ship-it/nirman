<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackagingCategory;
use App\Models\Packaging;

class PackagingController extends Controller
{
    public function categoryIndex()
    {
        $categories = PackagingCategory::latest()->get();

        return view('pages.packagingcategory.index', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('pages.packagingcategory.create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'category_code' => 'required|max:100|unique:packaging_categories,category_code',
        ]);

        PackagingCategory::create([
            'category_name' => $request->category_name,
            'category_code' => $request->category_code,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('packagingcategory.index')
            ->with('success', 'Packaging Category Created Successfully');
    }

   public function index()
{
    $packagings = Packaging::with('category')
        ->latest()
        ->get();

    return view('pages.packaging.index', compact('packagings'));
}
    public function create()
{


    $categories = PackagingCategory::where('status', 'Active')->get();

    return view('pages.packaging.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name'        => 'required',
        'code'        => 'required|unique:packagings,code',
        'category_id' => 'required|exists:packaging_categories,id',
        'level'       => 'required',
        'unit'        => 'required',
    ]);

    // dd($request->all());

    Packaging::create([
        'category_id'   => $request->category_id,
        'name'          => $request->name,
        'code'          => $request->code,
        'size'          => $request->size,
        'weight'        => $request->weight,        
        'height'        => $request->height,
        'fill_qty'      => $request->fill_qty,
        'level'         => $request->level,
        'unit'          => $request->unit,
        'rate_per_unit' => $request->rate_per_unit,
        'opening_stock' => $request->opening_stock,
        'alert_level'   => $request->alert_level,
        'status'        => $request->status,
    ]);

    return redirect()
        ->route('packaging.index')
        ->with('success', 'Packaging Material Created Successfully');
}
}