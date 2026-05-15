<?php
/*
##############################################################################
# iProduction - Production and Manufacture Management Software
##############################################################################
# AUTHOR:        Door Soft
##############################################################################
# EMAIL:        info@doorsoft.co
##############################################################################
# COPYRIGHT:        RESERVED BY Door Soft
##############################################################################
# WEBSITE:        https://www.doorsoft.co
##############################################################################
# This is SaleReturnController
##############################################################################
 */

namespace App\Http\Controllers;

use App\Account;
use App\AdminSettings;
use App\Customer;
use App\FinishedProduct;
use App\SaleDetail;
use App\SaleReturn;
use App\SaleReturnDetails;
use App\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleReturnController extends Controller
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
        $obj = SaleReturn::orderBy('id', 'DESC')->where('del_status', "Live")->get();
        $title = __('index.sale_return_list');
        return view('pages.sale_return.sale_returns', compact('title', 'obj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('index.add_sale_return');
        $sales = Sales::where('status', 'Final')
            ->where('del_status', 'Live')
            ->orderBy('id', 'DESC')
            ->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $ref_no = generateSaleReturnReference();
        return view('pages.sale_return.addEditSaleReturn', compact('title', 'ref_no', 'sales', 'accounts'));
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
            'reference_no' => 'required|max:50|unique:tbl_sale_return,reference_no',
            'sale_id' => 'required|exists:tbl_sales,id',
            'customer_id' => 'required|exists:tbl_customers,id',
            'date' => 'required|max:50',
            'return_status' => 'required|in:Draft,Final',
            'selected_product_id' => 'required',
            'quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price.*' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'account' => 'required|exists:tbl_accounts,id',
        ],
        [
            'reference_no.required' => __('index.reference_no_required'),
            'sale_id.required' => __('index.sale_required'),
            'customer_id.required' => __('index.customer_required'),
            'date.required' => __('index.date_required'),
            'return_status.required' => __('index.status_required'),
            'selected_product_id.required' => __('index.selected_product_id_required'),
            'paid.required' => __('index.paid_required'),
            'account.required' => __('index.account_required'),
        ]);

        DB::beginTransaction();
        try {
            $sale = Sales::find($request->sale_id);
            
            if (!$sale || $sale->del_status != 'Live' || $sale->status != 'Final') {
                return redirect()->back()->with(dangerMessage(__('index.sale_not_found_or_not_finalized')));
            }

            // Validate return quantities
            $product_ids = $request->get('selected_product_id');
            $quantity_list = $request->get('quantity_amount');
            $unit_prices = $request->get('unit_price');
            $sale_detail_ids = $request->get('sale_detail_id', []);

            foreach ($product_ids as $key => $product_id) {
                $sale_detail_id = isset($sale_detail_ids[$key]) ? $sale_detail_ids[$key] : null;
                $availableQty = getAvailableSaleReturnQuantity($sale->id, $product_id, $sale_detail_id);
                if ($quantity_list[$key] > $availableQty) {
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.return_quantity_exceeds_available', ['qty' => $availableQty])));
                }
            }

            // Calculate totals
            $subtotal = 0;
            foreach ($product_ids as $key => $product_id) {
                $subtotal += $quantity_list[$key] * $unit_prices[$key];
            }
            $other = null_check(escape_output($request->get('other', 0)));
            $discount = null_check(escape_output($request->get('discount', 0)));
            $grand_total = $subtotal + $other - $discount;
            $paid = null_check(escape_output($request->get('paid', 0)));
            $due = $grand_total - $paid;

            // Create Sale Return
            $saleReturn = new SaleReturn();
            $saleReturn->reference_no = null_check(escape_output($request->get('reference_no')));
            $saleReturn->sale_ref_no = $sale->reference_no;
            $saleReturn->sale_id = null_check(escape_output($request->get('sale_id')));
            $saleReturn->customer_id = null_check(escape_output($request->get('customer_id')));
            $saleReturn->return_date = escape_output($request->get('date'));
            $saleReturn->sale_date = $sale->sale_date;
            $saleReturn->return_status = escape_output($request->get('return_status'));
            $saleReturn->subtotal = $subtotal;
            $saleReturn->other = $other;
            $saleReturn->discount = $discount;
            $saleReturn->grand_total = $grand_total;
            $saleReturn->account_id = null_check(escape_output($request->get('account')));
            $saleReturn->paid = $paid;
            $saleReturn->due = $due;
            $saleReturn->note = escape_output($request->get('note', ''));
            if($request->get('change_currency')){
                $saleReturn->converted_currency_id = null_check(escape_output($request->get('currency_id')));
                $saleReturn->converted_amount = null_check(escape_output($request->get('converted_amount')));
            }
            $saleReturn->added_by = auth()->user()->id;
            $saleReturn->del_status = 'Live';
            $saleReturn->save();

            // Create Return Details
            foreach ($product_ids as $key => $product_id) {
                $sale_detail_id = isset($sale_detail_ids[$key]) ? $sale_detail_ids[$key] : null;
                $saleDetail = $sale_detail_id ? SaleDetail::find($sale_detail_id) : null;
                
                $detail = new SaleReturnDetails();
                $detail->sale_return_id = $saleReturn->id;
                $detail->sale_id = $sale->id;
                $detail->sale_detail_id = $sale_detail_id;
                $detail->product_id = null_check($product_id);
                if(isset($request->manufacture_id[$key]) && $request->manufacture_id[$key]){
                    $detail->manufacture_id = null_check($request->manufacture_id[$key]);
                }
                $detail->unit_price = null_check(escape_output($unit_prices[$key]));
                $detail->product_quantity = null_check(escape_output($quantity_list[$key]));
                $detail->total_amount = null_check(escape_output($quantity_list[$key] * $unit_prices[$key]));
                $detail->return_note = escape_output($request->get('return_note')[$key] ?? '');
                $detail->del_status = 'Live';
                $detail->save();
            }

            // If status is Final, adjust stock
            if ($request->get('return_status') == 'Final') {
                foreach ($product_ids as $key => $product_id) {
                    $product = FinishedProduct::findOrFail($product_id);
                    $product->current_total_stock = ($product->current_total_stock + $quantity_list[$key]);
                    $product->save();
                }
            }

            DB::commit();
            return redirect('sale-returns')->with(saveMessage());
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
        $saleReturn = SaleReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.view_sale_return_details');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $customer = Customer::find($saleReturn->customer_id);
        $originalSale = Sales::find($saleReturn->sale_id);
        $setting = getSettingsInfo();

        return view('pages.sale_return.viewSaleReturnDetails', compact('title', 'company', 'saleReturn', 'returnDetails', 'customer', 'originalSale', 'setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleReturn = SaleReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($saleReturn->return_status == 'Final') {
            return redirect('sale-returns')->with(dangerMessage(__('index.cannot_edit_finalized_return')));
        }

        $title = __('index.edit_sale_return');
        $sales = Sales::where('status', 'Final')
            ->where('del_status', 'Live')
            ->orderBy('id', 'DESC')
            ->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $originalSale = Sales::find($saleReturn->sale_id);

        return view('pages.sale_return.addEditSaleReturn', compact('title', 'saleReturn', 'sales', 'accounts', 'returnDetails', 'originalSale'));
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
        $saleReturn = SaleReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($saleReturn->return_status == 'Final') {
            return redirect('sale-returns')->with(dangerMessage(__('index.cannot_edit_finalized_return')));
        }

        request()->validate([
            'reference_no' => 'required|max:50|unique:tbl_sale_return,reference_no,' . $saleReturn->id,
            'sale_id' => 'required|exists:tbl_sales,id',
            'customer_id' => 'required|exists:tbl_customers,id',
            'date' => 'required|max:50',
            'return_status' => 'required|in:Draft,Final',
            'selected_product_id' => 'required',
            'quantity_amount.*' => 'required|numeric|min:0.01',
            'unit_price.*' => 'required|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'account' => 'required|exists:tbl_accounts,id',
        ],
        [
            'reference_no.required' => __('index.reference_no_required'),
            'sale_id.required' => __('index.sale_required'),
            'customer_id.required' => __('index.customer_required'),
            'date.required' => __('index.date_required'),
            'return_status.required' => __('index.status_required'),
            'selected_product_id.required' => __('index.selected_product_id_required'),
            'paid.required' => __('index.paid_required'),
            'account.required' => __('index.account_required'),
        ]);

        DB::beginTransaction();
        try {
            $sale = Sales::find($request->sale_id);
            
            if (!$sale || $sale->del_status != 'Live' || $sale->status != 'Final') {
                return redirect()->back()->with(dangerMessage(__('index.sale_not_found_or_not_finalized')));
            }

            // Validate return quantities (excluding current return)
            $product_ids = $request->get('selected_product_id');
            $quantity_list = $request->get('quantity_amount');
            $unit_prices = $request->get('unit_price');
            $sale_detail_ids = $request->get('sale_detail_id', []);

            foreach ($product_ids as $key => $product_id) {
                $sale_detail_id = isset($sale_detail_ids[$key]) ? $sale_detail_ids[$key] : null;
                $availableQty = getAvailableSaleReturnQuantity($sale->id, $product_id, $sale_detail_id);
                // Add back the quantity from current return being edited
                $currentReturnQty = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
                    ->where('product_id', $product_id)
                    ->where('del_status', 'Live')
                    ->sum('product_quantity');
                $availableQty += $currentReturnQty;

                if ($quantity_list[$key] > $availableQty) {
                    return redirect()->back()
                        ->withInput()
                        ->with(dangerMessage(__('index.return_quantity_exceeds_available', ['qty' => $availableQty])));
                }
            }

            // Calculate totals
            $subtotal = 0;
            foreach ($product_ids as $key => $product_id) {
                $subtotal += floatval($quantity_list[$key]) * floatval($unit_prices[$key]);
            }
            
            $other = floatval($request->get('other', 0));
            $discount_str = $request->get('discount', 0);
            // Parse discount - handle percentage or fixed amount
            $discount = 0;
            if ($discount_str && $discount_str != '' && $discount_str != '0') {
                if (strpos($discount_str, '%') !== false) {
                    // Percentage discount
                    $discount_parts = explode('%', $discount_str);
                    $discount_percent = floatval(trim($discount_parts[0]));
                    $discount = $subtotal * ($discount_percent / 100);
                } else {
                    // Fixed amount discount
                    $discount = floatval($discount_str);
                }
            }
            $grand_total = $subtotal + $other - $discount;
            $paid = floatval($request->get('paid', 0));
            $due = $grand_total - $paid;

            $oldStatus = $saleReturn->return_status;
            $oldAccountId = $saleReturn->account_id;
            $oldTotal = $saleReturn->grand_total;

            // Revert stock if old status was Final
            if ($oldStatus == 'Final') {
                $oldDetails = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
                    ->where('del_status', 'Live')
                    ->get();
                foreach ($oldDetails as $oldDetail) {
                    $product = FinishedProduct::find($oldDetail->product_id);
                    if ($product) {
                        $product->current_total_stock = ($product->current_total_stock - $oldDetail->product_quantity);
                        $product->save();
                    }
                }
                
                // Revert account balance - check if balance column exists and update if present
                // Note: Account balance is usually calculated, but some systems maintain a balance column
                if ($oldAccountId) {
                    try {
                        $hasBalanceColumn = DB::select("SHOW COLUMNS FROM tbl_accounts LIKE 'balance'");
                        if (!empty($hasBalanceColumn)) {
                            $oldBalance = DB::table('tbl_accounts')->where('id', $oldAccountId)->value('balance');
                            if ($oldBalance !== null) {
                                DB::table('tbl_accounts')
                                    ->where('id', $oldAccountId)
                                    ->update(['balance' => $oldBalance + $oldTotal]);
                            }
                        }
                    } catch (\Exception $e) {
                        // Balance column doesn't exist or error - balance will be recalculated
                        Log::info('Account balance column not found or error updating: ' . $e->getMessage());
                    }
                }
            }

            // Update Sale Return
            $saleReturn->reference_no = null_check(escape_output($request->get('reference_no')));
            $saleReturn->sale_ref_no = $sale->reference_no;
            $saleReturn->sale_id = null_check(escape_output($request->get('sale_id')));
            $saleReturn->customer_id = null_check(escape_output($request->get('customer_id')));
            $saleReturn->return_date = escape_output($request->get('date'));
            $saleReturn->sale_date = $sale->sale_date;
            $saleReturn->return_status = escape_output($request->get('return_status'));
            $saleReturn->subtotal = $subtotal;
            $saleReturn->other = $other;
            $saleReturn->discount = $discount;
            $saleReturn->grand_total = $grand_total;
            $saleReturn->account_id = null_check(escape_output($request->get('account')));
            $saleReturn->paid = $paid;
            $saleReturn->due = $due;
            $saleReturn->note = escape_output($request->get('note', ''));
            if($request->get('change_currency')){
                $saleReturn->converted_currency_id = null_check(escape_output($request->get('currency_id')));
                $saleReturn->converted_amount = null_check(escape_output($request->get('converted_amount')));
            } else {
                $saleReturn->converted_currency_id = null;
                $saleReturn->converted_amount = null;
            }
            $saleReturn->save();

            // Delete old details
            SaleReturnDetails::where('sale_return_id', $saleReturn->id)
                ->update(['del_status' => 'Deleted']);

            // Create new Return Details
            foreach ($product_ids as $key => $product_id) {
                $sale_detail_id = isset($sale_detail_ids[$key]) ? $sale_detail_ids[$key] : null;
                
                $detail = new SaleReturnDetails();
                $detail->sale_return_id = $saleReturn->id;
                $detail->sale_id = $sale->id;
                $detail->sale_detail_id = $sale_detail_id;
                $detail->product_id = null_check($product_id);
                if(isset($request->manufacture_id[$key]) && $request->manufacture_id[$key]){
                    $detail->manufacture_id = null_check($request->manufacture_id[$key]);
                }
                $detail->unit_price = floatval($unit_prices[$key]);
                $detail->product_quantity = floatval($quantity_list[$key]);
                $detail->total_amount = floatval($quantity_list[$key] * $unit_prices[$key]);
                $detail->return_note = escape_output($request->get('return_note')[$key] ?? '');
                $detail->del_status = 'Live';
                $detail->save();
            }

            // If new status is Final, adjust stock and account
            if ($request->get('return_status') == 'Final') {
                foreach ($product_ids as $key => $product_id) {
                    $product = FinishedProduct::findOrFail($product_id);
                    $product->current_total_stock = ($product->current_total_stock + $quantity_list[$key]);
                    $product->save();
                }
                
                // Adjust account balance - check if balance column exists and update if present
                // Note: Account balance is usually calculated, but some systems maintain a balance column
                $accountId = $request->get('account');
                if ($accountId) {
                    try {
                        $hasBalanceColumn = DB::select("SHOW COLUMNS FROM tbl_accounts LIKE 'balance'");
                        if (!empty($hasBalanceColumn)) {
                            $currentBalance = DB::table('tbl_accounts')->where('id', $accountId)->value('balance');
                            if ($currentBalance !== null) {
                                DB::table('tbl_accounts')
                                    ->where('id', $accountId)
                                    ->update(['balance' => $currentBalance - $grand_total]);
                            }
                        }
                    } catch (\Exception $e) {
                        // Balance column doesn't exist or error - balance will be recalculated
                        Log::info('Account balance column not found or error updating: ' . $e->getMessage());
                    }
                }
            }

            DB::commit();
            return redirect('sale-returns')->with(updateMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Sale Return Update Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
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
        $saleReturn = SaleReturn::find(encrypt_decrypt($id, 'decrypt'));
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        if ($saleReturn->return_status == 'Final') {
            return redirect('sale-returns')->with(dangerMessage(__('index.cannot_delete_finalized_return')));
        }

        // Soft delete return details
        SaleReturnDetails::where('sale_return_id', $saleReturn->id)
            ->update(['del_status' => 'Deleted']);

        // Soft delete return
        $saleReturn->del_status = 'Deleted';
        $saleReturn->save();

        return redirect('sale-returns')->with(deleteMessage());
    }

    /**
     * Print Sale Return Invoice
     */
    public function printReturn($id)
    {
        $saleReturn = SaleReturn::find($id);
        
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.sale_return_invoice');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $customer = Customer::find($saleReturn->customer_id);
        $originalSale = Sales::find($saleReturn->sale_id);
        $setting = getSettingsInfo();

        return view('pages.sale_return.print_sale_return_invoice', compact('title', 'company', 'saleReturn', 'returnDetails', 'customer', 'originalSale', 'setting'));
    }

    /**
     * Download Sale Return Invoice PDF
     */
    public function downloadReturn($id)
    {
        $id = encrypt_decrypt($id, 'decrypt');
        $saleReturn = SaleReturn::find($id);
        if (!$saleReturn || $saleReturn->del_status != 'Live') {
            return redirect('sale-returns')->with(dangerMessage(__('index.record_not_found')));
        }

        $title = __('index.sale_return_invoice');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
        $returnDetails = SaleReturnDetails::where('sale_return_id', $saleReturn->id)
            ->where('del_status', 'Live')
            ->get();
        $customer = Customer::find($saleReturn->customer_id);
        $originalSale = Sales::find($saleReturn->sale_id);
        $setting = getSettingsInfo();

        $pdf = Pdf::loadView('pages.sale_return.print_sale_return_invoice', compact('title', 'company', 'saleReturn', 'returnDetails', 'customer', 'originalSale', 'setting'));
        
        // Set PDF options with margins
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('margin-top', 15);
        $pdf->setOption('margin-bottom', 15);
        $pdf->setOption('margin-left', 15);
        $pdf->setOption('margin-right', 15);

        return $pdf->download($saleReturn->reference_no . '.pdf');
    }

    /**
     * Get Sale Items for Return (AJAX)
     */
    public function getSaleItems($sale_id)
    {
        $sale = Sales::find($sale_id);
        
        if (!$sale || $sale->del_status != 'Live' || $sale->status != 'Final') {
            return response()->json(['error' => __('index.sale_not_found_or_not_finalized')], 404);
        }

        $saleItems = SaleDetail::where('sale_id', $sale->id)
            ->where('del_status', 'Live')
            ->with('product')
            ->get();

        $items = [];
        foreach ($saleItems as $item) {
            $returnedQty = getTotalSaleReturnedQuantity($sale->id, $item->product_id, $item->id);
            $availableQty = $item->product_quantity - $returnedQty;

            $product = $item->product;
            $manufactureInfo = $item->manufacture_id ? getManufactureInfo($item->manufacture_id) : null;

            $items[] = [
                'id' => $item->product_id,
                'sale_detail_id' => $item->id,
                'name' => $product->name ?? '',
                'code' => $product->code ?? '',
                'unit' => getRMUnitById($product->unit ?? ''),
                'sold_quantity' => $item->product_quantity,
                'returned_quantity' => $returnedQty,
                'available_quantity' => $availableQty,
                'unit_price' => $item->unit_price,
                'total' => $item->total_amount,
                'manufacture_id' => $item->manufacture_id,
                'manufacture_info' => $manufactureInfo ? [
                    'batch_no' => $manufactureInfo->batch_no ?? '',
                    'expiry_date' => $manufactureInfo->expiry_days && $manufactureInfo->complete_date ? 
                        getDateFormat(expireDate($manufactureInfo->complete_date, $manufactureInfo->expiry_days)) : ''
                ] : null
            ];
        }

        return response()->json([
            'sale' => [
                'id' => $sale->id,
                'reference_no' => $sale->reference_no,
                'date' => $sale->sale_date,
                'customer_id' => $sale->customer_id,
                'customer_name' => getCustomerNameById($sale->customer_id),
            ],
            'items' => $items
        ]);
    }
}

