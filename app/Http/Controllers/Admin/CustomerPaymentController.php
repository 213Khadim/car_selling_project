<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerPayment;
use App\Models\Sale;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{
    public function index()
    {
        $payments  = CustomerPayment::with(['customer', 'sale'])->latest()->paginate(15);
        $customers = Customer::all();
        $sales     = Sale::with('customer')->get();

        return view('admin.customer-payments', compact('payments', 'customers', 'sales'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'sale_id'      => 'nullable|exists:sales,id',
            'amount'       => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'method'       => 'required|string|max:50',
            'notes'        => 'nullable|string',
        ]);

        CustomerPayment::create($validated);

        return redirect()->route('admin.customer-payments')->with('success', 'Payment recorded successfully.');
    }

    public function destroy(CustomerPayment $customerPayment)
    {
        $customerPayment->delete();

        return redirect()->route('admin.customer-payments')->with('success', 'Payment deleted.');
    }
}
