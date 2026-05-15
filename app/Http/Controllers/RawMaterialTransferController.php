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
  # This is RawMaterialTransferController
  ##############################################################################
 */

namespace App\Http\Controllers;

use App\AdminSettings;
use App\Outlet;
use App\RawMaterial;
use App\RawMaterialTransfer;
use App\RawMaterialTransferDetails;
use App\StockAdjustLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RawMaterialTransferController extends Controller
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
        $obj = RawMaterialTransfer::orderBy('id', 'DESC')->where('del_status', "Live")->get();
        $title = __('index.raw_material_transfers');
        return view('pages.raw_material_transfer.index', compact('title', 'obj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('index.add_raw_material_transfer');
        $outlets = Outlet::where('del_status', 'Live')->orderBy('outlet_name', 'ASC')->get();
        $rawMaterials = RawMaterial::where('del_status', 'Live')->orderBy('name', 'ASC')->get();
        $currentOutletId = Session::get('outlet_id');
        $ref_no = RawMaterialTransfer::generateReferenceNo();
        return view('pages.raw_material_transfer.create', compact('title', 'ref_no', 'outlets', 'rawMaterials', 'currentOutletId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'transfer_reference_no' => 'required|max:50|unique:tbl_raw_material_transfers,transfer_reference_no',
            'from_outlet_id' => 'required|exists:tbl_outlets,id',
            'to_outlet_id' => 'required|exists:tbl_outlets,id|different:from_outlet_id',
            'transfer_date' => 'required|date',
            'rm_id' => 'required|array|min:1',
            'rm_id.*' => 'required|exists:tbl_rawmaterials,id',
            'quantity_amount' => 'required|array|min:1',
            'quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price' => 'required|array',
            'unit_price.*' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:1000',
        ], [
            'from_outlet_id.required' => __('index.from_outlet_required'),
            'to_outlet_id.required' => __('index.to_outlet_required'),
            'to_outlet_id.different' => __('index.outlets_must_be_different'),
            'transfer_date.required' => __('index.transfer_date_required'),
            'rm_id.required' => __('index.at_least_one_raw_material_required'),
            'quantity_amount.*.required' => __('index.quantity_required'),
            'quantity_amount.*.min' => __('index.quantity_min'),
        ]);

        DB::beginTransaction();
        try {
            // Validate stock availability
            $originalOutletId = Session::get('outlet_id');
            Session::put('outlet_id', $request->from_outlet_id);
            
            $rm_id = $request->get('rm_id');
            $quantity_amount = $request->get('quantity_amount');
            $unit_price = $request->get('unit_price');
            $total = $request->get('total');
            
            foreach ($rm_id as $row => $rawMaterialId) {
                $rm = RawMaterial::find($rawMaterialId);
                if (!$rm) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()->withInput()->with(dangerMessage(__('index.raw_material_not_found')));
                }
                
                $availableStock = $rm->current_stock;
                $requestedQuantity = $quantity_amount[$row] ?? 0;
                if ($requestedQuantity > $availableStock) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.insufficient_stock', ['material' => $rm->name, 'available' => $availableStock])));
                }
            }

            // Create Transfer
            $transfer = new RawMaterialTransfer();
            $transfer->transfer_reference_no = null_check(escape_output($request->transfer_reference_no));
            $transfer->from_outlet_id = null_check(escape_output($request->from_outlet_id));
            $transfer->to_outlet_id = null_check(escape_output($request->to_outlet_id));
            $transfer->transfer_date = escape_output($request->transfer_date);
            $transfer->transfer_status = 'Draft';
            $transfer->note = escape_output($request->note);
            $transfer->added_by = Auth::id();
            $transfer->del_status = 'Live';
            $transfer->outlet_id = $request->from_outlet_id;
            $transfer->save();

            // Create Transfer Details
            foreach ($rm_id as $row => $rawMaterialId) {
                $detail = new RawMaterialTransferDetails();
                $detail->transfer_id = $transfer->id;
                $detail->raw_material_id = null_check($rawMaterialId);
                $detail->quantity = null_check(escape_output($quantity_amount[$row] ?? 0));
                $detail->unit_price = null_check(escape_output($unit_price[$row] ?? 0));
                $detail->total_amount = null_check(escape_output($total[$row] ?? ($detail->quantity * $detail->unit_price)));
                $detail->note = '';
                $detail->del_status = 'Live';
                $detail->outlet_id = $request->from_outlet_id;
                $detail->save();
            }

            Session::put('outlet_id', $originalOutletId);
            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(saveMessage());
        } catch (\Exception $e) {
            Session::put('outlet_id', $originalOutletId ?? Session::get('outlet_id'));
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
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.view_raw_material_transfer');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $transferDetails = RawMaterialTransferDetails::where('transfer_id', $transfer->id)
            ->where('del_status', 'Live')
            ->get();

        return view('pages.raw_material_transfer.show', compact('title', 'company', 'transfer', 'transferDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($transfer->transfer_status != 'Draft') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.cannot_edit_completed_transfer')));
        }

        $title = __('index.edit_raw_material_transfer');
        $outlets = Outlet::where('del_status', 'Live')->orderBy('outlet_name', 'ASC')->get();
        $rawMaterials = RawMaterial::where('del_status', 'Live')->orderBy('name', 'ASC')->get();
        $transferDetails = RawMaterialTransferDetails::where('transfer_id', $transfer->id)
            ->where('del_status', 'Live')
            ->get();

        return view('pages.raw_material_transfer.edit', compact('title', 'transfer', 'outlets', 'rawMaterials', 'transferDetails'));
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
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($transfer->transfer_status != 'Draft') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.cannot_edit_completed_transfer')));
        }

        $request->validate([
            'transfer_reference_no' => 'required|max:50|unique:tbl_raw_material_transfers,transfer_reference_no,' . $transfer->id,
            'from_outlet_id' => 'required|exists:tbl_outlets,id',
            'to_outlet_id' => 'required|exists:tbl_outlets,id|different:from_outlet_id',
            'transfer_date' => 'required|date',
            'transfer_status' => 'required|in:Draft,Pending,In Transit,Completed,Cancelled',
            'rm_id' => 'required|array|min:1',
            'rm_id.*' => 'required|exists:tbl_rawmaterials,id',
            'quantity_amount' => 'required|array|min:1',
            'quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price' => 'required|array',
            'unit_price.*' => 'nullable|numeric|min:0',
            'note' => 'nullable|string|max:1000',
        ], [
            'from_outlet_id.required' => __('index.from_outlet_required'),
            'to_outlet_id.required' => __('index.to_outlet_required'),
            'to_outlet_id.different' => __('index.outlets_must_be_different'),
            'transfer_date.required' => __('index.transfer_date_required'),
            'rm_id.required' => __('index.at_least_one_raw_material_required'),
            'quantity_amount.*.required' => __('index.quantity_required'),
            'quantity_amount.*.min' => __('index.quantity_min'),
        ]);

        DB::beginTransaction();
        try {
            // Validate stock availability
            $originalOutletId = Session::get('outlet_id');
            Session::put('outlet_id', $request->from_outlet_id);
            
            $rm_id = $request->get('rm_id');
            $quantity_amount = $request->get('quantity_amount');
            $unit_price = $request->get('unit_price');
            $total = $request->get('total');
            
            // Get old details for stock adjustment
            $oldDetails = RawMaterialTransferDetails::where('transfer_id', $transfer->id)
                ->where('del_status', 'Live')
                ->get()
                ->keyBy('raw_material_id');
            
            foreach ($rm_id as $row => $rawMaterialId) {
                $rm = RawMaterial::find($rawMaterialId);
                if (!$rm) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()->withInput()->with(dangerMessage(__('index.raw_material_not_found')));
                }
                
                $availableStock = $rm->current_stock;
                // For update, we need to add back the old quantity if same material
                $oldDetail = $oldDetails->get($rawMaterialId);
                $adjustedStock = $availableStock + ($oldDetail ? $oldDetail->quantity : 0);
                $requestedQuantity = $quantity_amount[$row] ?? 0;
                
                if ($requestedQuantity > $adjustedStock) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.insufficient_stock', ['material' => $rm->name, 'available' => $adjustedStock])));
                }
            }

            // Update Transfer
            $transfer->transfer_reference_no = null_check(escape_output($request->transfer_reference_no));
            $transfer->from_outlet_id = null_check(escape_output($request->from_outlet_id));
            $transfer->to_outlet_id = null_check(escape_output($request->to_outlet_id));
            $transfer->transfer_date = escape_output($request->transfer_date);
            $transfer->transfer_status = escape_output($request->transfer_status);
            $transfer->note = escape_output($request->note);
            $transfer->outlet_id = $request->from_outlet_id;
            
            // Update approved_by and approved_at if status changed to Pending or In Transit
            if (in_array($request->transfer_status, ['Pending', 'In Transit']) && !$transfer->approved_by) {
                $transfer->approved_by = Auth::id();
                $transfer->approved_at = now();
            }
            
            // Update received_by and received_at if status changed to Completed
            if ($request->transfer_status == 'Completed' && !$transfer->received_by) {
                $transfer->received_by = Auth::id();
                $transfer->received_at = now();
            }
            
            $transfer->save();

            // Delete old details
            RawMaterialTransferDetails::where('transfer_id', $transfer->id)
                ->where('del_status', 'Live')
                ->update(['del_status' => 'Deleted']);

            // Create new Transfer Details
            foreach ($rm_id as $row => $rawMaterialId) {
                $detail = new RawMaterialTransferDetails();
                $detail->transfer_id = $transfer->id;
                $detail->raw_material_id = null_check($rawMaterialId);
                $detail->quantity = null_check(escape_output($quantity_amount[$row] ?? 0));
                $detail->unit_price = null_check(escape_output($unit_price[$row] ?? 0));
                $detail->total_amount = null_check(escape_output($total[$row] ?? ($detail->quantity * $detail->unit_price)));
                $detail->note = '';
                $detail->del_status = 'Live';
                $detail->outlet_id = $request->from_outlet_id;
                $detail->save();
            }

            Session::put('outlet_id', $originalOutletId);
            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(updateMessage());
        } catch (\Exception $e) {
            Session::put('outlet_id', $originalOutletId ?? Session::get('outlet_id'));
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
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($transfer->transfer_status != 'Draft') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.cannot_delete_completed_transfer')));
        }

        DB::beginTransaction();
        try {
            $transfer->del_status = 'Deleted';
            $transfer->save();

            RawMaterialTransferDetails::where('transfer_id', $transfer->id)
                ->where('del_status', 'Live')
                ->update(['del_status' => 'Deleted']);

            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(deleteMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Approve transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if (!in_array($transfer->transfer_status, ['Draft', 'Pending'])) {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.transfer_already_processed')));
        }

        DB::beginTransaction();
        try {
            // Validate stock availability
            $originalOutletId = Session::get('outlet_id');
            Session::put('outlet_id', $transfer->from_outlet_id);
            
            foreach ($transfer->transferDetails as $detail) {
                $rm = $detail->rawMaterial;
                $availableStock = $rm->current_stock;
                if ($detail->quantity > $availableStock) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()
                        ->with(dangerMessage(__('index.insufficient_stock', ['material' => $rm->name, 'available' => $availableStock])));
                }
            }

            $transfer->transfer_status = 'Pending';
            $transfer->approved_by = Auth::id();
            $transfer->approved_at = now();
            $transfer->save();

            // Update outlet_id in transfer details to from_outlet_id (items still at source)
            RawMaterialTransferDetails::where('transfer_id', $transfer->id)
                ->where('del_status', 'Live')
                ->update(['outlet_id' => $transfer->from_outlet_id]);

            Session::put('outlet_id', $originalOutletId);
            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(saveMessage(__('index.transfer_approved')));
        } catch (\Exception $e) {
            Session::put('outlet_id', $originalOutletId ?? Session::get('outlet_id'));
            DB::rollBack();
            return redirect()->back()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Complete transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if (!$transfer->canBeCompleted()) {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.transfer_cannot_be_completed')));
        }

        DB::beginTransaction();
        try {
            $originalOutletId = Session::get('outlet_id');

            // Validate stock availability
            Session::put('outlet_id', $transfer->from_outlet_id);
            foreach ($transfer->transferDetails as $detail) {
                $rm = $detail->rawMaterial;
                $availableStock = $rm->current_stock;
                if ($detail->quantity > $availableStock) {
                    Session::put('outlet_id', $originalOutletId);
                    return redirect()->back()
                        ->with(dangerMessage(__('index.insufficient_stock', ['material' => $rm->name, 'available' => $availableStock])));
                }
            }

            // Adjust stock for source outlet (subtract)
            Session::put('outlet_id', $transfer->from_outlet_id);
            foreach ($transfer->transferDetails as $detail) {
                $sourceAdjustLog = new StockAdjustLog();
                $sourceAdjustLog->rm_id = $detail->raw_material_id;
                $sourceAdjustLog->type = 'subtraction';
                $sourceAdjustLog->quantity = $detail->quantity;
                $sourceAdjustLog->outlet_id = $transfer->from_outlet_id;
                $sourceAdjustLog->save();
            }

            // Adjust stock for destination outlet (add)
            Session::put('outlet_id', $transfer->to_outlet_id);
            foreach ($transfer->transferDetails as $detail) {
                $destAdjustLog = new StockAdjustLog();
                $destAdjustLog->rm_id = $detail->raw_material_id;
                $destAdjustLog->type = 'addition';
                $destAdjustLog->quantity = $detail->quantity;
                $destAdjustLog->outlet_id = $transfer->to_outlet_id;
                $destAdjustLog->save();
            }

            // Update transfer status
            $transfer->transfer_status = 'Completed';
            $transfer->received_by = Auth::id();
            $transfer->received_at = now();
            $transfer->save();

            // Update outlet_id in transfer details to to_outlet_id (items now at destination)
            RawMaterialTransferDetails::where('transfer_id', $transfer->id)
                ->where('del_status', 'Live')
                ->update(['outlet_id' => $transfer->to_outlet_id]);

            Session::put('outlet_id', $originalOutletId);
            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(saveMessage(__('index.transfer_completed')));
        } catch (\Exception $e) {
            Session::put('outlet_id', $originalOutletId ?? Session::get('outlet_id'));
            DB::rollBack();
            return redirect()->back()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Cancel transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        if (!$transfer->canBeCancelled()) {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.cannot_cancel_completed_transfer')));
        }

        DB::beginTransaction();
        try {
            $transfer->transfer_status = 'Cancelled';
            $transfer->save();

            DB::commit();
            return redirect()->route('raw-material-transfers.index')->with(saveMessage(__('index.transfer_cancelled')));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(dangerMessage($e->getMessage()));
        }
    }

    /**
     * Get raw material stock for transfer (AJAX)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRawMaterialStock(Request $request)
    {
        $rawMaterialId = $request->raw_material_id;
        $outletId = $request->outlet_id;

        if (!$rawMaterialId || !$outletId) {
            return response()->json(['error' => __('index.invalid_parameters')], 400);
        }

        $originalOutletId = Session::get('outlet_id');
        Session::put('outlet_id', $outletId);

        $rawMaterial = RawMaterial::find($rawMaterialId);
        if (!$rawMaterial) {
            Session::put('outlet_id', $originalOutletId);
            return response()->json(['error' => __('index.raw_material_not_found')], 404);
        }

        $stock = $rawMaterial->current_stock;
        Session::put('outlet_id', $originalOutletId);

        return response()->json([
            'stock' => $stock,
            'unit' => $rawMaterial->unit ? $rawMaterial->unit->name : '',
        ]);
    }

    /**
     * Print transfer document
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printTransfer($id)
    {
        $transfer = RawMaterialTransfer::find(encrypt_decrypt($id, 'decrypt'));
        if (!$transfer || $transfer->del_status != 'Live') {
            return redirect()->route('raw-material-transfers.index')->with(dangerMessage(__('index.record_not_found')));
        }

        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->first();
        $transferDetails = RawMaterialTransferDetails::where('transfer_id', $transfer->id)
            ->where('del_status', 'Live')
            ->get();

        $pdf = Pdf::loadView('pages.raw_material_transfer.print_transfer', compact('transfer', 'transferDetails', 'company'));
        return $pdf->stream('transfer-' . $transfer->transfer_reference_no . '.pdf');
    }
}

