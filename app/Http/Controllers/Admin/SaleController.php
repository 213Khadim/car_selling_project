<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with(['car', 'customer', 'user']);

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('search')) {
            $q = $request->search;
            $query->whereHas('customer', fn ($sub) => $sub->where('name', 'like', "%$q%"))
                  ->orWhereHas('car', fn ($sub) => $sub->where('name', 'like', "%$q%"));
        }

        $sales     = $query->latest()->paginate(15);
        $cars      = Car::where('status', '!=', 'sold')->get();
        $customers = Customer::all();

        return view('admin.sales', compact('sales', 'cars', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id'         => 'required|exists:cars,id',
            'customer_id'    => 'required|exists:customers,id',
            'sale_price'     => 'required|numeric|min:0',
            'sale_date'      => 'required|date',
            'payment_status' => 'required|in:pending,partial,paid',
            'notes'          => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $sale = Sale::create($validated);

        // Mark car as sold
        Car::find($validated['car_id'])->update(['status' => 'sold']);

        return redirect()->route('admin.sales')->with('success', 'Sale recorded successfully.');
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,partial,paid',
            'notes'          => 'nullable|string',
        ]);

        $sale->update($validated);

        return redirect()->route('admin.sales')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        // Revert car status
        $sale->car->update(['status' => 'reached']);
        $sale->delete();

        return redirect()->route('admin.sales')->with('success', 'Sale deleted successfully.');
    }
}
