<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $title = __('index.list_currency');
        $obj = Currency::where('del_status', 'Live')
        ->orderBy('id', 'desc') // latest first
        ->get();
        return view('pages.currency.index', compact('obj', 'title'));
    }

    public function create()
    {
        $title = __('index.add_currency');
        return view('pages.currency.addEditCurrency');
    }

    public function store(Request $request)
    {
        $request->validate([
             'currency_name' => 'required|string|max:50',
            'symbol' => 'required|string|max:10',
            'conversion_rate' => 'required|numeric|min:0',
             'inr_value' => 'nullable|numeric|min:0'
        ]);

        Currency::create([
             'currency_name' => $request->currency_name,
            'symbol' => $request->symbol,
            'conversion_rate' => $request->conversion_rate,
               'inr_value' => $request->inr_value,
        ]);

        return redirect()->route('currency.index')->with(saveMessage());
    }

    public function edit($id)
    {
        $title = 'Edit Currency';
        $obj = Currency::find(encrypt_decrypt($id, 'decrypt'));
        return view('pages.currency.addEditCurrency', compact('obj', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
             'currency_name' => 'required|string|max:50',
            'symbol' => 'required|string|max:10',
            'conversion_rate' => 'required|numeric|min:0',
           'inr_value' => 'nullable|numeric|min:0'
        ]);

        $currency = Currency::find($id);
        $currency->currency_name = $request->currency_name;
        $currency->symbol = $request->symbol;
        $currency->conversion_rate = $request->conversion_rate;
        $currency->inr_value = $request->inr_value;
        $currency->save();

        return redirect()->route('currency.index')->with(updateMessage());
    }

    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->del_status = 'Deleted';
        $currency->save();
        return redirect()->route('currency.index')->with(deleteMessage());
    }

    public function updateFromPopup(Request $request)
{
    $currency = Currency::find($request->currency_id);
    $currency->conversion_rate = $request->conversion_rate;
    $currency->save();

    // store in session
    session([
        'currency_id' => $currency->id,
        'currency_symbol' => $currency->symbol,
        'conversion_rate' => $currency->conversion_rate
    ]);

    return response()->json([
        'status' => 'success',
        'symbol' => $currency->symbol,
        'rate' => $currency->conversion_rate
    ]);
}
}

