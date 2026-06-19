<?php
namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SupplierMaterial;
use App\PackagingMaterial;
use App\RawMaterial;
use App\RawMaterialCategory;
use Illuminate\Support\Facades\DB;
use App\Models\PackagingCategory;
use App\Models\Packaging;
use App\Models\SupplierMaterialAssignment;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = Supplier::orderBy('id','DESC')->where('del_status',"Live")->get();
        $title =  __('index.suppliers');
        return view('pages.supplier.suppliers',compact('title','obj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title =  __('index.add_supplier');
        return view('pages.supplier.addEditSupplier',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|max:50',
            'contact_person' => 'max:50',
            'phone' => 'required',
            'email' => 'email:filter',
            'address' => 'max:250',
            'note' => 'max:250'
        ],
        [
            'name.required' => __('index.name_required'),
            'phone.required' => __('index.phone_required'),
            'email.email' => __('index.email_validation'),
        ]);

        $obj = new \App\Supplier;
        $obj->name = escape_output($request->get('name'));
        $obj->contact_person = escape_output($request->get('contact_person'));
        $obj->phone = escape_output($request->get('phone'));
        $obj->email = escape_output($request->get('email'));
        $obj->address = escape_output($request->get('address'));
        $obj->opening_balance = null_check(escape_output($request->get('opening_balance')));
        $obj->opening_balance_type = escape_output($request->get('opening_balance_type'));
        $obj->note = escape_output($request->get('note'));
        $obj->added_by = auth()->user()->id;
        $obj->company_id = null_check(auth()->user()->company_id);
        $obj->credit_limit = null_check(escape_output($request->get('credit_limit')));
        $obj->save();
        return redirect('suppliers')->with(saveMessage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find(encrypt_decrypt($id, 'decrypt'));
        $title =  __('index.edit_supplier');
        $obj = $supplier;
        return view('pages.supplier.addEditSupplier',compact('title','obj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        request()->validate([
            'name' => 'required|max:50',
            'contact_person' => 'max:50',
            'phone' => 'required',
            'email' => 'email:filter',
            'address' => 'max:250',
            'note' => 'max:250'
        ],[
            'name.required' => __('index.name_required'),
            'phone.required' => __('index.phone_required'),
            'email.email' => __('index.email_validation'),
        ]);

        $supplier->name = escape_output($request->get('name'));
        $supplier->contact_person = escape_output($request->get('contact_person'));
        $supplier->phone = escape_output($request->get('phone'));
        $supplier->email = escape_output($request->get('email'));
        $supplier->opening_balance = null_check(escape_output($request->get('opening_balance')));
        $supplier->opening_balance_type = escape_output($request->get('opening_balance_type'));
        $supplier->address = escape_output($request->get('address'));
        $supplier->note = escape_output($request->get('note'));
        $supplier->added_by = auth()->user()->id;
        $supplier->credit_limit = null_check(escape_output($request->get('credit_limit')));

        $supplier->save();
        return redirect('suppliers')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->del_status = "Deleted";
        $supplier->save();
        return redirect('suppliers')->with(deleteMessage());
    }


public function materialsIndex($id)
{
    $supplier = Supplier::findOrFail(
        encrypt_decrypt($id, 'decrypt')
    );

    $materials = DB::table('supplier_material_assignments as sma')

        ->leftJoin('tbl_rawmaterials as rm', 'rm.id', '=', 'sma.raw_material_id')

        ->leftJoin('packagings as p', 'p.id', '=', 'sma.packaging_id')

        ->leftJoin('tbl_rmcategory as rmc', 'rmc.id', '=', 'rm.category')

        ->leftJoin('packaging_categories as pc', 'pc.id', '=', 'p.category_id')

        ->where('sma.supplier_id', $supplier->id)

        ->select(
            'sma.id',

            'sma.raw_material_id',
            'sma.packaging_id',

            'rm.name as raw_name',
            'rm.code as raw_code',
            'rm.unit as raw_unit',

            'rmc.name as raw_category',

            'p.name as packaging_name',
            'p.code as packaging_code',
            'p.unit as packaging_unit',

            'pc.category_name as packaging_category'
        )

        ->latest('sma.id')
        ->get();

    return view(
        'pages.supplier.assign_materials',
        compact(
            'supplier',
            'materials'
        )
    );
}
public function createMaterial($id)
{
    $supplier = Supplier::findOrFail(
        encrypt_decrypt($id, 'decrypt')
    );

    // Raw Material Categories
    $rawCategories = RawMaterialCategory::where('del_status', 'Live')
        ->orderBy('name')
        ->get();

    $rawMaterials = RawMaterial::where('del_status', 'Live')
        ->orderBy('name')
        ->get()
        ->groupBy('category');

    // Packaging Categories
    $packagingCategories = PackagingCategory::where('status', 'Active')
        ->orderBy('category_name')
        ->get();

    $packagingMaterials = Packaging::where('status', 'Active')
        ->orderBy('name')
        ->get()
        ->groupBy('category_id');

    // Already assigned raw materials
    $assignedRawMaterials = SupplierMaterialAssignment::where(
            'supplier_id',
            $supplier->id
        )
        ->whereNotNull('raw_material_id')
        ->pluck('raw_material_id')
        ->toArray();

    // Already assigned packaging materials
    $assignedPackagingMaterials = SupplierMaterialAssignment::where(
            'supplier_id',
            $supplier->id
        )
        ->whereNotNull('packaging_id')
        ->pluck('packaging_id')
        ->toArray();

    $title = 'Assign Materials';

    return view(
        'pages.supplier.add_material',
        compact(
            'title',
            'supplier',
            'rawCategories',
            'rawMaterials',
            'packagingCategories',
            'packagingMaterials',
            'assignedRawMaterials',
            'assignedPackagingMaterials'
        )
    );
}
public function storeMaterial(Request $request, $id)
{
    $supplier = Supplier::findOrFail(
        encrypt_decrypt($id, 'decrypt')
    );

    DB::beginTransaction();

    try {


        if ($request->has('raw_materials')) {

            foreach ($request->raw_materials as $rawMaterialId) {

                SupplierMaterialAssignment::firstOrCreate(
                    [
                        'supplier_id'     => $supplier->id,
                        'raw_material_id' => $rawMaterialId
                    ],
                    [
                        'packaging_id' => null
                    ]
                );
            }
        }



        if ($request->has('packaging_materials')) {

            foreach ($request->packaging_materials as $packagingId) {

                SupplierMaterialAssignment::firstOrCreate(
                    [
                        'supplier_id'  => $supplier->id,
                        'packaging_id' => $packagingId
                    ],
                    [
                        'raw_material_id' => null
                    ]
                );
            }
        }

        DB::commit();

        return redirect()
            ->route(
                'suppliers.materials.index',
                encrypt_decrypt($supplier->id, 'encrypt')
            )
            ->with(
                'success',
                'Materials Assigned Successfully'
            );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with(
            'error',
            $e->getMessage()
        );
    }
}
public function materials($id)
{
   return view(
        'pages.supplier.assign_materials');
}
}
