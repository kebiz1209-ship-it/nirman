<?php
/*
##############################################################################
# iProduction - Production and Manufacture Management Software
##############################################################################
# This is FPCategoryController
##############################################################################
*/

namespace App\Http\Controllers;

use App\FPCategory;
use Illuminate\Http\Request;

class FPCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display category list
     */
    // public function index()
    // {
    //     $obj = FPCategory::orderBy('id', 'DESC')
    //         ->where('del_status', "Live")
    //         ->get();

    //     $title = __('index.product_categories');

    //     return view('pages.fpcategory.fpcategories', compact('title', 'obj'));
    // }


public function index()
{
    $obj = FPCategory::orderBy('id', 'DESC')
        ->where('del_status', "Live")
        ->get();

    // Get last code
    $lastCategory = FPCategory::orderBy('id', 'DESC')->first();

    if ($lastCategory && $lastCategory->code) {
        $number = (int) preg_replace('/[^0-9]/', '', $lastCategory->code);
        $nextCode = 'PC' . str_pad($number + 1, 2, '0', STR_PAD_LEFT);
    } else {
        $nextCode = 'PC01';
    }

    // Safety check
    while (FPCategory::where('code', $nextCode)->exists()) {
        $number++;
        $nextCode = 'PC' . str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    $title = __('index.product_categories');

    return view('pages.fpcategory.fpcategories', compact('title', 'obj', 'nextCode'));
}
    /**
     * Show create form
     */
    public function create()
    {
        $title = __('index.add_product_category');
        return view('pages.fpcategory.addEditFPCategory', compact('title'));
    }

    /**
     * Store new category
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:150',
    ]);

    $lastCategory = FPCategory::orderBy('id', 'DESC')->first();

    if ($lastCategory && $lastCategory->code) {
        $number = (int) preg_replace('/[^0-9]/', '', $lastCategory->code);
        $newCode = 'PC' . str_pad($number + 1, 2, '0', STR_PAD_LEFT);
    } else {
        $number = 1;
        $newCode = 'PC01';
    }

    while (FPCategory::where('code', $newCode)->exists()) {
        $number++;
        $newCode = 'PC' . str_pad($number, 2, '0', STR_PAD_LEFT);
    }

    $obj = new FPCategory();
    $obj->code = $newCode;
    $obj->name = $request->name;
    $obj->description = $request->description;
    $obj->save();

    return redirect()->route('fpcategories.index')
        ->with('success', 'Category created successfully');
}

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $fpcategory = FPCategory::find(encrypt_decrypt($id, 'decrypt'));

        $title = __('index.edit_product_category');
        $obj = $fpcategory;

        return view('pages.fpcategory.addEditFPCategory', compact('title', 'obj'));
    }

    /**
     * Update category
     */
    public function update(Request $request, FPCategory $fpcategory)
    {
        request()->validate([
            'name' => 'required|max:50',
            'description' => 'max:250'
        ]);

        // Code remains unchanged
        $fpcategory->name = escape_output($request->get('name'));
        $fpcategory->description = escape_output($request->get('description'));
        $fpcategory->save();

        return redirect('fpcategories')->with(updateMessage());
    }



    public function destroy(FPCategory $fpcategory)
{
    if ($fpcategory->products()->count() > 0) {
        return redirect()->back()
            ->with('error', 'Cannot delete category. Products exist under this category.');
    }

    $fpcategory->del_status = "Deleted";
    $fpcategory->save();

    return redirect('fpcategories')->with(deleteMessage());
}
}