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
# This is SalesController
##############################################################################
 */

namespace App\Http\Controllers;

use App\Account;
use App\AdminSettings;
use App\Customer;
use App\FinishedProduct;
use App\Manufacture;
use App\SaleDetail;
use App\Sales;
use App\Quotation;
use App\QuotationDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index()
{
    $obj = Sales::orderBy('id', 'DESC')->where('del_status', "Live")->get();
    $title = __('index.sales_list');

    // ✅ Load all currencies as a lookup map: id => symbol
    $currencies = DB::table('tbl_currency')->get()->keyBy('id');

    return view('pages.sales.sales', compact('title', 'obj', 'currencies'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
{
    $title = __('index.add_sale');
    $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
    $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $obj_rm = Sales::count();
    $ref_no = "SO-" . str_pad($obj_rm + 1, 6, '0', STR_PAD_LEFT);

    // ✅ Defaults for new sale
    $currencySymbol = '₹';
    $conversionRate = 1;

    return view('pages.sales.addEditSale', compact(
        'title', 'ref_no', 'customers', 'finishProducts',
        'accounts', 'fifoProducts', 'currencySymbol', 'conversionRate'
    ));
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
        'reference_no' => 'required|max:50',
        'customer_id' => 'required|max:150',
        'status' => 'required|max:50',
        'date' => 'required|max:50',
        'selected_product_id' => 'required|max:50',
        'paid' => 'required|max:50',
        'account' => 'required|max:50',
    ]);

    DB::beginTransaction();
    try {
        $quantity_list = $request->get('quantity_amount');
        $rm_id = $request->get('rm_id');

        $total_quantity = 0;
        $manufacture_details = [];

        for ($i = 0; $i < sizeof($quantity_list); $i++) {
            $total_quantity = $total_quantity + $quantity_list[$i];
            $manufacture_id = $rm_id[$i];
            $selected_quantity = $quantity_list[$i];

            $manufacture = array($manufacture_id => $selected_quantity);
            array_push($manufacture_details, $manufacture);
            if ($request->status == 'Final') {
                $manufacture_info = Manufacture::where('id', $manufacture_id)->first();
                if ($manufacture_info) {
                    $existing_qty = $manufacture_info->product_quantity;
                    $manufacture_info->product_quantity = ($existing_qty - $selected_quantity);
                    $manufacture_info->save();
                }
            }
        }

        $obj = new \App\Sales();
        $obj->reference_no = null_check(escape_output($request->get('reference_no')));
        $obj->customer_id = null_check(escape_output($request->get('customer_id')));
        $obj->sale_date = escape_output($request->get('date'));
        $obj->status = escape_output($request->get('status'));
        $obj->product_quantity = null_check($total_quantity);
        $obj->subtotal = null_check(escape_output($request->get('subtotal')));
        $obj->other = null_check(escape_output($request->get('other')));
        $obj->discount = null_check(escape_output($request->get('discount')));
        $obj->grand_total = null_check(escape_output($request->get('grand_total')));
        $obj->account_id = null_check(null_check(escape_output($request->get('account'))));
        $obj->paid = null_check(null_check(escape_output($request->get('paid'))));
        $obj->due = null_check(escape_output($request->get('due')));
        $obj->note = escape_output($request->get('note'));
        
        // ✅ Save ONLY currency_id - NO conversion fields
        $currencyId = $request->currency_id_direct ?: $request->currency_id;

$obj->currency_id = $currencyId ?: null;

        $obj->added_by = auth()->user()->id;
        $obj->created_at = date('Y-m-d H:i:s');
        $obj->save();

        $sale_details = $request->get('selected_product_id');
        $unit_price = $request->get('unit_price');
        $total = $request->get('total');

        for ($x = 0; $x < sizeof($sale_details); $x++) {
            $obj2 = new \App\SaleDetail();
            $obj2->sale_id = null_check($obj->id);
            $obj2->product_id = null_check($sale_details[$x]);
            $obj2->unit_price = null_check($unit_price[$x]);
            $obj2->product_quantity = null_check($quantity_list[$x]);
            $obj2->total_amount = null_check($total[$x]);
            $obj2->del_status = 'Live';
            $obj2->created_at = date('Y-m-d H:i:s');
            if(isset($request->manufacture_id[$x])){
                $obj2->manufacture_id = null_check($request->manufacture_id[$x]);
            }
            $obj2->save();
        }

        if ($request->status == 'Final') {
            foreach ($request->selected_product_id as $key => $value) {
                $product = FinishedProduct::findOrFail($value);
                $product->current_total_stock = ($product->current_total_stock - $quantity_list[$key]);
                $product->save();
            }
        }

        DB::commit();
        return redirect('sales')->with(saveMessage());
        
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with(dangerMessage($e->getMessage()));
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
        $id = encrypt_decrypt($id, 'decrypt');
        $title = __('index.view_sale_details');

        $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

        $obj = Sales::findOrFail($id);

        $sale_details = SaleDetail::where('sale_id', $id)->where('del_status', 'Live')->get();

        return view('pages.sales.viewSalesDetails', compact('title', 'obj', 'customers', 'finishProducts', 'accounts', 'fifoProducts', 'sale_details'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
{
    $title = __('index.sales_invoice');
    $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
    $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
    $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

    $obj = Sales::findOrFail($id);
    $setting = getSettingsInfo();

    // ✅ Look up sale currency
    $saleCurrency = null;
    if ($obj->currency_id) {
        $saleCurrency = DB::table('tbl_currency')->where('id', $obj->currency_id)->first();
    }

    $sale_details = DB::table('tbl_sale_details')
        ->select('product_id', DB::raw('sum(unit_price) as unit_price'), DB::raw('sum(product_quantity) as product_quantity'), DB::raw('sum(total_amount) as total_amount'))
        ->where('sale_id', $id)
        ->where('del_status', 'Live')
        ->groupBy('product_id')
        ->get();

    $type = request('type', 'inr');

    return view('pages.sales.salesInvoice', compact(
        'title', 'obj', 'customers', 'setting', 'finishProducts',
        'accounts', 'fifoProducts', 'company', 'sale_details',
        'type', 'saleCurrency'
    ));
}

public function downloadInvoice($id)
{
    $id = encrypt_decrypt($id, 'decrypt');
    $title = __('index.sales_invoice');
    $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();
    $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
    $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

    $obj = Sales::findOrFail($id);
    $setting = getSettingsInfo();

    // ✅ Look up sale currency
    $saleCurrency = null;
    if ($obj->currency_id) {
        $saleCurrency = DB::table('tbl_currency')->where('id', $obj->currency_id)->first();
    }

    $sale_details = DB::table('tbl_sale_details')
        ->select('product_id', DB::raw('sum(unit_price) as unit_price'), DB::raw('sum(product_quantity) as product_quantity'), DB::raw('sum(total_amount) as total_amount'))
        ->where('sale_id', $id)
        ->where('del_status', 'Live')
        ->groupBy('product_id')
        ->get();

    $type = request('type', 'inr');

    $pdf = Pdf::loadView('pages.sales.salesInvoice', compact(
        'title', 'obj', 'sale_details', 'setting', 'customers',
        'finishProducts', 'accounts', 'fifoProducts', 'company',
        'type', 'saleCurrency'
    ));

    return $pdf->download($obj->reference_no . '-' . $type . '.pdf');
}
    public function downloadChallan($id)
    {
        $id = encrypt_decrypt($id, 'decrypt');
        $title = __('index.challan');
        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();

        $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

        $obj = Sales::findOrFail($id);
        $setting = getSettingsInfo();
        $sale_details = DB::table('tbl_sale_details')
            ->select('product_id', DB::raw('sum(unit_price) as unit_price'), DB::raw('sum(product_quantity) as product_quantity'), DB::raw('sum(total_amount) as total_amount'))
            ->where('sale_id', $id)
            ->where('del_status', 'Live')
            ->groupBy('product_id')
            ->get();
        $baseURL = getBaseURL();
        $whiteLabelInfo = getWhiteLabelInfo();
        $pdf = Pdf::loadView('pages.sales.challan', compact('title', 'obj', 'sale_details', 'setting', 'customers', 'finishProducts', 'accounts', 'fifoProducts', 'company'));
        return $pdf->download($obj->reference_no . '.pdf');
    }

    public function challan($id)
    {
        $title = __('index.challan');

        $company = AdminSettings::orderBy('name_company_name', 'ASC')->where('del_status', "Live")->get();

        $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
        $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
        $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

        $obj = Sales::findOrFail($id);
        $setting = getSettingsInfo();
        $sale_details = DB::table('tbl_sale_details')
            ->select('product_id', DB::raw('sum(unit_price) as unit_price'), DB::raw('sum(product_quantity) as product_quantity'), DB::raw('sum(total_amount) as total_amount'))
            ->where('sale_id', $id)
            ->where('del_status', 'Live')
            ->groupBy('product_id')
            ->get();
        $baseURL = getBaseURL();
        $whiteLabelInfo = getWhiteLabelInfo();
        return view('pages.sales.challan', compact('title', 'obj', 'customers', 'setting', 'finishProducts', 'accounts', 'fifoProducts', 'company', 'sale_details', 'baseURL', 'whiteLabelInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $id = encrypt_decrypt($id, 'decrypt');
    $title = __('index.edit_sale');
    $customers = Customer::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $finishProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->get();
    $fifoProducts = FinishedProduct::orderBy('name', 'ASC')->where('del_status', "Live")->where('stock_method', "fifo")->get();
    $accounts = Account::orderBy('name', 'ASC')->where('del_status', "Live")->get();

    $obj = Sales::findOrFail($id);

    $sale_details = SaleDetail::where('sale_id', $id)->where('del_status', 'Live')->get();

    // ✅ Look up currency symbol and rate from currency_id
    $currencySymbol = '₹';
    $conversionRate = 1;

    if ($obj->currency_id) {
        $currency = DB::table('tbl_currency')->where('id', $obj->currency_id)->first();
        if ($currency) {
            $currencySymbol = $currency->symbol;
            $conversionRate = $currency->conversion_rate;
        }
    }

    return view('pages.sales.addEditSale', compact(
        'title', 'obj', 'customers', 'finishProducts',
        'accounts', 'fifoProducts', 'sale_details',
        'currencySymbol', 'conversionRate'
    ));
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
    try {
        request()->validate([
            'reference_no' => 'required|max:50',
            'customer_id' => 'required|max:150',
            'status' => 'required|max:50',
            'date' => 'required|max:50',
            'selected_product_id' => 'required|max:50',
            'paid' => 'required|max:50',
            'account' => 'required|max:50',
        ],
        [
            'reference_no.required' => __('index.reference_no_required'),
            'customer_id.required' => __('index.customer_required'),
            'status.required' => __('index.status_required'),
            'date.required' => __('index.date_required'),
            'selected_product_id.required' => __('index.selected_product_id_required'),
            'paid.required' => __('index.paid_required'),
            'account.required' => __('index.account_required'),
        ]);

        DB::beginTransaction();

        $quantity_list = $request->get('quantity_amount');
        $rm_id = $request->get('rm_id');

        $total_quantity = 0;
        $manufacture_details = [];

        for ($i = 0; $i < count($quantity_list); $i++) {
            $total_quantity = $total_quantity + $quantity_list[$i];
            $manufacture_id = $rm_id[$i];
            $selected_quantity = $quantity_list[$i];

            $manufacture = array($manufacture_id => $selected_quantity);
            array_push($manufacture_details, $manufacture);
            if ($request->status == 'Final') {
                $manufacture_info = Manufacture::where('id', $manufacture_id)->first();
                if ($manufacture_info) {
                    $existing_qty = $manufacture_info->product_quantity;
                    $manufacture_info->product_quantity = ($existing_qty - $selected_quantity);
                    $manufacture_info->save();
                }
            }
        }

        $obj = Sales::findOrFail($id);

        $obj->reference_no = null_check(escape_output($request->get('reference_no')));
        $obj->customer_id = null_check(escape_output($request->get('customer_id')));
        $obj->sale_date = escape_output($request->get('date'));
        $obj->status = escape_output($request->get('status'));
        $obj->product_quantity = null_check($total_quantity);
        $obj->subtotal = null_check(escape_output($request->get('subtotal')));
        $obj->other = null_check(escape_output($request->get('other')));
        $obj->discount = null_check(escape_output($request->get('discount')));
        $obj->grand_total = null_check(escape_output($request->get('grand_total')));
        $obj->account_id = null_check(escape_output($request->get('account')));
        $obj->paid = null_check(escape_output($request->get('paid')));
        $obj->due = null_check(escape_output($request->get('due')));
        $obj->note = escape_output($request->get('note'));
        $obj->updated_at = date('Y-m-d H:i:s');
        
        // ✅ Save currency ID - ONLY this field, no other currency-related fields
        $currencyId = $request->currency_id_direct ?: $request->currency_id;

$obj->currency_id = $currencyId ?: null;
        
        $obj->save();

        // Delete old sale details
        SaleDetail::where('sale_id', $id)->update(['del_status' => "Deleted"]);

        $sale_details = null_check($request->get('selected_product_id'));
        $unit_price = null_check($request->get('unit_price'));
        $total = null_check($request->get('total'));

        for ($x = 0; $x < sizeof($sale_details); $x++) {
            $obj2 = new \App\SaleDetail();
            $obj2->sale_id = $obj->id;
            $obj2->product_id = $sale_details[$x];
            $obj2->unit_price = $unit_price[$x];
            $obj2->product_quantity = $quantity_list[$x];
            $obj2->total_amount = $total[$x];
            $obj2->del_status = 'Live';
            if(isset($request->manufacture_id[$x])){
                $obj2->manufacture_id = null_check($request->manufacture_id[$x]);
            }
            $obj2->save();
        }
        
        if ($request->status == 'Final') {
            foreach ($request->selected_product_id as $key => $value) {
                $product = FinishedProduct::findOrFail($value);
                $product->current_total_stock = ($product->current_total_stock - $quantity_list[$key]);
                $product->save();
            }
        }
        
        DB::commit();
        return redirect(('sales'))->with(saveMessage());
        
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect('sales')->with(dangerMessage($e->getMessage()));
    }
}

public function updatePopup(Request $request)
{
    try {
        // Store the selected currency in session or cache
        session([
            'selected_currency_id' => $request->currency_id,
            'conversion_rate' => $request->conversion_rate
        ]);
        
        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
	
	public function destroy($id)
    {
        Sales::where('id', $id)->update(['del_status' => "Deleted"]);
        return redirect('sales')->with(deleteMessage());
    }

    /**
     * Convert Quotation to Sales
     * 
     * @param  int  $id (Quotation ID - encrypted)
     * @return \Illuminate\Http\Response
     */
    public function convertFromQuotation($id)
    {
        try {
            DB::beginTransaction();
            
            // Decrypt quotation ID if encrypted
            $quotationId = encrypt_decrypt($id, 'decrypt');
            
            // Get the quotation record with relationships
            $quotation = Quotation::with(['quotationDetails', 'customer'])->findOrFail($quotationId);
            
            // Validate quotation exists and is not deleted
            if ($quotation->del_status == 'Deleted') {
                return redirect()->back()->with(dangerMessage(__('index.quotation_not_found')));
            }
            
            // Check if quotation already has details
            $quotationDetails = QuotationDetail::where('quotation_id', $quotation->id)
                ->where('del_status', 'Live')
                ->get();
            
            if ($quotationDetails->isEmpty()) {
                return redirect()->back()->with(dangerMessage(__('index.quotation_no_products')));
            }
            
            // Generate new sales reference number
            $obj_rm = Sales::count();
            $ref_no = "SO-" . str_pad($obj_rm + 1, 6, '0', STR_PAD_LEFT);
            
            // Calculate total quantity
            $total_quantity = 0;
            foreach ($quotationDetails as $detail) {
                $total_quantity += $detail->quantity_amount;
            }
            
            // Create sales from quotation data
            $sales = Sales::create([
                'reference_no' => $ref_no,
                'customer_id' => $quotation->customer_id,
                'sale_date' => $quotation->date,
                'status' => 'Draft', // Default to Draft status
                'product_quantity' => $total_quantity,
                'subtotal' => $quotation->subtotal ?? 0,
                'other' => $quotation->other ?? 0,
                'discount' => $quotation->discount ?? 0,
                'grand_total' => $quotation->grand_total ?? 0,
                'paid' => 0, // Default to 0 for new sales
                'due' => $quotation->grand_total ?? 0, // Set due to grand total initially
                'note' => $quotation->note ?? '',
                'added_by' => auth()->user()->id,
                'quotation_id' => $quotation->id, // Track the source quotation
                'company_id' => $quotation->company_id ?? 1,
            ]);
            
            // Copy quotation details to sale details
            foreach ($quotationDetails as $quotationDetail) {
                SaleDetail::create([
                    'sale_id' => $sales->id,
                    'product_id' => $quotationDetail->finishProduct_id,
                    'unit_price' => $quotationDetail->unit_price,
                    'product_quantity' => $quotationDetail->quantity_amount,
                    'total_amount' => $quotationDetail->total,
                    'del_status' => 'Live',
                    'company_id' => $quotation->company_id ?? 1,
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('sales.edit', encrypt_decrypt($sales->id, 'encrypt'))
                ->with(saveMessage(__('index.sales_created_from_quotation')));
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(dangerMessage($e->getMessage()));
        }
    }
}