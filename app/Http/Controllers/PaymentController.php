<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get();

        return view('pages.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('pages.payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_name' => 'required|unique:payments,payment_name',
        ]);

        Payment::create([
            'payment_name' => $request->payment_name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment created successfully');
    }

    public function edit(Payment $payment)
    {
        return view('pages.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_name' => 'required|unique:payments,payment_name,' . $payment->id,
        ]);

        $payment->update([
            'payment_name' => $request->payment_name,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment deleted successfully');
    }
}