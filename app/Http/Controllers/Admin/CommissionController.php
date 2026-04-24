<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index()
    {
        $commissions = Commission::with(['sale', 'user'])->latest()->paginate(15);
        $sales       = Sale::with('car')->get();
        $users       = User::all();

        return view('admin.commissions', compact('commissions', 'sales', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'user_id' => 'nullable|exists:users,id',
            'amount'  => 'required|numeric|min:0',
            'notes'   => 'nullable|string',
        ]);

        Commission::create($validated);

        return redirect()->route('admin.commissions')->with('success', 'Commission added successfully.');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();

        return redirect()->route('admin.commissions')->with('success', 'Commission deleted.');
    }
}
