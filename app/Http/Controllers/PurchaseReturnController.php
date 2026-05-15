<?php
/*
  ##############################################################################
  # iProduction - Production and Manufacture Management Software
  ##############################################################################
  # AUTHOR:		Door Soft
  ##############################################################################
  # EMAIL:		info@doorsoft.co
  ##############################################################################
  # COPYRIGHT:		RESERVED BY Door Soft
  ##############################################################################
  # WEBSITE:		https://www.doorsoft.co
  ##############################################################################
  # This is PurchaseReturnController
  ##############################################################################
 */

namespace App\Http\Controllers;

use App\Account;
use App\AdminSettings;
use App\PurchaseReturn;
use App\PurchaseReturnDetails;
use App\RawMaterial;
use App\RawMaterialPurchase;
use App\RMPurchase_model;
use App\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseReturnController extends Controller
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
        $obj = PurchaseReturn::orderBy('id', 'DESC')->where('del_status', "Live")->get();
        $title = __('index.purchase_return');
        return view('pages.purchase_return.purchase_returns', compact('title', 'obj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('index.add_purchase_return');
        $purchases = RawMaterialPurchase::where('status', 'Final')
            ->where('del_status', 'Live')
            ->orderBy('id', 'DESC')
            ->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $ref_no = generatePurchaseReturnReference();
        return view('pages.purchase_return.addEditPurchaseReturn', compact('title', 'ref_no', 'purchases', 'accounts'));
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
            'reference_no' => 'required|max:255',
            'pur_ref_no' => 'required|max:255',
            'supplier_id' => 'required|exists:tbl_suppliers,id',
            'date' => 'required|max:30',
            'return_status' => 'required|in:Draft,Final',
            'item_id.*' => 'required|exists:tbl_rawmaterials,id',
            'return_quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $purchase = RawMaterialPurchase::where('reference_no', $request->pur_ref_no)
                ->where('del_status', 'Live')
                ->where('status', 'Final')
                ->first();

            if (!$purchase) {
                return redirect()->back()->with(dangerMessage(__('index.purchase_not_found_or_not_finalized')));
            }

            // Validate return quantities
            $item_ids = $request->get('item_id');
            $return_quantities = $request->get('return_quantity_amount');
            $unit_prices = $request->get('unit_price');

            foreach ($item_ids as $key => $item_id) {
                $availableQty = getAvailableReturnQuantity($purchase->id, $item_id);
                if ($return_quantities[$key] > $availableQty) {
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.return_quantity_exceeds_available', ['qty' => $availableQty])));
                }
            }

            // Create Purchase Return
            $purchaseReturn = new PurchaseReturn();
            $purchaseReturn->reference_no = null_check(escape_output($request->get('reference_no')));
            $purchaseReturn->pur_ref_no = null_check(escape_output($request->get('pur_ref_no')));
            $purchaseReturn->date = escape_output($request->get('date'));
            $purchaseReturn->purchase_date = $purchase->date;
            $purchaseReturn->supplier_id = null_check(escape_output($request->get('supplier_id')));
            $purchaseReturn->return_status = escape_output($request->get('return_status'));
            $purchaseReturn->payment_method_id = null_check(escape_output($request->get('payment_method_id', 1)));
            $purchaseReturn->payment_method_type = escape_output($request->get('payment_method_type'));
            $purchaseReturn->account_type = escape_output($request->get('account_type'));
            $purchaseReturn->note = escape_output($request->get('note'));
            $purchaseReturn->added_date = date('Y-m-d H:i:s');
            $purchaseReturn->user_id = auth()->user()->id;
            $purchaseReturn->del_status = 'Live';

            // Calculate total
            $total = 0;
            foreach ($item_ids as $key => $item_id) {
                $total += $return_quantities[$key] * $unit_prices[$key];
            }
            $purchaseReturn->total_return_amount = $total;
            $purchaseReturn->save();

            // Create Return Details
            foreach ($item_ids as $key => $item_id) {
                $detail = new PurchaseReturnDetails();
                $detail->pur_return_id = $purchaseReturn->id;
                $detail->item_id = null_check($item_id);
                $detail->item_type = 'raw_material';
                $detail->return_quantity_amount = null_check(escape_output($return_quantities[$key]));
                $detail->unit_price = null_check(escape_output($unit_prices[$key]));
                $detail->total = null_check(escape_output($return_quantities[$key] * $unit_prices[$key]));
                $detail->return_status = escape_output($request->get('return_status'));
                $detail->return_note = escape_output($request->get('return_note')[$key] ?? '');
                $detail->user_id = auth()->user()->id;
                $detail->del_status = 'Live';
                $detail->save();
            }

            // If status is Final, adjust stock and supplier payment
            if ($request->get('return_status') == 'Final') {
                // Stock is automatically adjusted via RawMaterial model's getCurrentStockAttribute
                // which subtracts returns from stock calculation
                
                // Supplier payment adjustment would be handled here if needed
                // This depends on how supplier payments are managed in the system
            }

            DB::commit();
            return redirect('purchasereturns')->with(saveMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseReturn = PurchaseReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.view_purchase_return_details');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $supplier = Supplier::find($purchaseReturn->supplier_id);
        $originalPurchase = RawMaterialPurchase::where('reference_no', $purchaseReturn->pur_ref_no)->first();

        return view('pages.purchase_return.viewDetails', compact('title', 'company', 'purchaseReturn', 'returnDetails', 'supplier', 'originalPurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseReturn = PurchaseReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($purchaseReturn->return_status == 'Final') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.cannot_edit_finalized_return')));
        }

        $title = __('index.edit_purchase_return');
        $purchases = RawMaterialPurchase::where('status', 'Final')
            ->where('del_status', 'Live')
            ->orderBy('id', 'DESC')
            ->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $originalPurchase = RawMaterialPurchase::where('reference_no', $purchaseReturn->pur_ref_no)->first();

        return view('pages.purchase_return.addEditPurchaseReturn', compact('title', 'purchaseReturn', 'purchases', 'accounts', 'returnDetails', 'originalPurchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchaseReturn = PurchaseReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($purchaseReturn->return_status == 'Final') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.cannot_edit_finalized_return')));
        }

        request()->validate([
            'reference_no' => 'required|max:255',
            'pur_ref_no' => 'required|max:255',
            'supplier_id' => 'required|exists:tbl_suppliers,id',
            'date' => 'required|max:30',
            'return_status' => 'required|in:Draft,Final',
            'item_id.*' => 'required|exists:tbl_rawmaterials,id',
            'return_quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $purchase = RawMaterialPurchase::where('reference_no', $request->pur_ref_no)
                ->where('del_status', 'Live')
                ->where('status', 'Final')
                ->first();

            if (!$purchase) {
                return redirect()->back()->with(dangerMessage(__('index.purchase_not_found_or_not_finalized')));
            }

            // Validate return quantities (excluding current return)
            $item_ids = $request->get('item_id');
            $return_quantities = $request->get('return_quantity_amount');
            $unit_prices = $request->get('unit_price');

            foreach ($item_ids as $key => $item_id) {
                $availableQty = getAvailableReturnQuantity($purchase->id, $item_id);
                // Add back the quantity from current return being edited
                $currentReturnQty = PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
                    ->where('item_id', $item_id)
                    ->where('del_status', 'Live')
                    ->sum('return_quantity_amount');
                $availableQty += $currentReturnQty;

                if ($return_quantities[$key] > $availableQty) {
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.return_quantity_exceeds_available', ['qty' => $availableQty])));
                }
            }

            // Update Purchase Return
            $purchaseReturn->reference_no = null_check(escape_output($request->get('reference_no')));
            $purchaseReturn->pur_ref_no = null_check(escape_output($request->get('pur_ref_no')));
            $purchaseReturn->date = escape_output($request->get('date'));
            $purchaseReturn->purchase_date = $purchase->date;
            $purchaseReturn->supplier_id = null_check(escape_output($request->get('supplier_id')));
            $oldStatus = $purchaseReturn->return_status;
            $purchaseReturn->return_status = escape_output($request->get('return_status'));
            $purchaseReturn->payment_method_id = null_check(escape_output($request->get('payment_method_id', 1)));
            $purchaseReturn->payment_method_type = escape_output($request->get('payment_method_type'));
            $purchaseReturn->account_type = escape_output($request->get('account_type'));
            $purchaseReturn->note = escape_output($request->get('note'));

            // Calculate total
            $total = 0;
            foreach ($item_ids as $key => $item_id) {
                $total += $return_quantities[$key] * $unit_prices[$key];
            }
            $purchaseReturn->total_return_amount = $total;
            $purchaseReturn->save();

            // Delete old details
            PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
                ->update(['del_status' => 'Deleted']);

            // Create new Return Details
            foreach ($item_ids as $key => $item_id) {
                $detail = new PurchaseReturnDetails();
                $detail->pur_return_id = $purchaseReturn->id;
                $detail->item_id = null_check($item_id);
                $detail->item_type = 'raw_material';
                $detail->return_quantity_amount = null_check(escape_output($return_quantities[$key]));
                $detail->unit_price = null_check(escape_output($unit_prices[$key]));
                $detail->total = null_check(escape_output($return_quantities[$key] * $unit_prices[$key]));
                $detail->return_status = escape_output($request->get('return_status'));
                $detail->return_note = escape_output($request->get('return_note')[$key] ?? '');
                $detail->user_id = auth()->user()->id;
                $detail->del_status = 'Live';
                $detail->save();
            }

            // If status changed to Final, adjust stock
            if ($oldStatus != 'Final' && $request->get('return_status') == 'Final') {
                // Stock is automatically adjusted via RawMaterial model
            }

            DB::commit();
            return redirect('purchasereturns')->with(updateMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseReturn = PurchaseReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($purchaseReturn->return_status == 'Final') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.cannot_delete_finalized_return')));
        }

        // Soft delete return details
        PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
            ->update(['del_status' => 'Deleted']);

        // Soft delete return
        $purchaseReturn->del_status = 'Deleted';
        $purchaseReturn->save();

        return redirect('purchasereturns')->with(deleteMessage());
    }

    /**
     * Print Purchase Return Invoice
     */
    public function printReturn($id)
    {
        // Use plain ID like purchase print does
        $purchaseReturn = PurchaseReturn::find($id);
        
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            // For print requests, show an error page instead of redirecting
            return view('pages.purchase_return.print_error', [
                'message' => __('index.record_not_found')
            ]);
        }

        $title = __('index.purchase_return_invoice');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $supplier = Supplier::find($purchaseReturn->supplier_id);
        $originalPurchase = RawMaterialPurchase::where('reference_no', $purchaseReturn->pur_ref_no)->first();
        $setting = getSettingsInfo();

        return view('pages.purchase_return.print_purchase_return_invoice', compact('title', 'company', 'purchaseReturn', 'returnDetails', 'supplier', 'originalPurchase', 'setting'));
    }

    /**
     * Download Purchase Return Invoice PDF
     */
    public function downloadReturn($id)
    {
        $id = encrypt_decrypt($id, 'decrypt');
        $purchaseReturn = PurchaseReturn::find($id);
        if (!$purchaseReturn || $purchaseReturn->del_status != 'Live') {
            return redirect('purchasereturns')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.purchase_return_invoice');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = PurchaseReturnDetails::where('pur_return_id', $purchaseReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $supplier = Supplier::find($purchaseReturn->supplier_id);
        $originalPurchase = RawMaterialPurchase::where('reference_no', $purchaseReturn->pur_ref_no)->first();
        $setting = getSettingsInfo();

        $pdf = PDF::loadView('pages.purchase_return.print_purchase_return_invoice', compact('purchaseReturn', 'company', 'returnDetails', 'supplier', 'originalPurchase', 'setting'));
        
        // Set PDF options with margins
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('margin-top', 15);
        $pdf->setOption('margin-bottom', 15);
        $pdf->setOption('margin-left', 15);
        $pdf->setOption('margin-right', 15);

        return $pdf->download($purchaseReturn->reference_no . '.pdf');
    }

    /**
     * Get Purchase Items for Return (AJAX)
     */
    public function getPurchaseItems($purchase_id)
    {
        // Purchase ID comes directly from data attribute, no encryption needed
        $purchase = RawMaterialPurchase::find($purchase_id);
        
        if (!$purchase || $purchase->del_status != 'Live' || $purchase->status != 'Final') {
            return response()->json(['error' => 'Purchase not found or not finalized'], 404);
        }

        $purchaseItems = RMPurchase_model::where('purchase_id', $purchase->id)
            ->where('del_status', 'Live')
            ->with('rawmaterial')
            ->get();

        $items = [];
        foreach ($purchaseItems as $item) {
            $returnedQty = getTotalReturnedQuantity($item->rmaterials_id, $purchase->id);
            $availableQty = $item->quantity_amount - $returnedQty;

            $items[] = [
                'id' => $item->rmaterials_id,
                'name' => $item->rawmaterial->name ?? '',
                'unit' => getRMUnitById($item->rawmaterial->unit ?? ''),
                'purchased_quantity' => $item->quantity_amount,
                'returned_quantity' => $returnedQty,
                'available_quantity' => $availableQty,
                'unit_price' => $item->unit_price,
                'total' => $item->total,
            ];
        }

        return response()->json([
            'purchase' => [
                'id' => $purchase->id,
                'reference_no' => $purchase->reference_no,
                'date' => $purchase->date,
                'supplier_id' => $purchase->supplier,
                'supplier_name' => getSupplierName($purchase->supplier),
            ],
            'items' => $items
        ]);
    }
}

