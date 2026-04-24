<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashAccount;
use Illuminate\Http\Request;

class CashAccountController extends Controller
{
    public function index()
    {
        $accounts = CashAccount::latest()->get();
        $total    = $accounts->sum('balance');

        return view('admin.cash-accounts', compact('accounts', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'type'     => 'required|in:bank,cash',
            'balance'  => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'notes'    => 'nullable|string',
        ]);

        CashAccount::create($validated);

        return redirect()->route('admin.cash-accounts')->with('success', 'Account created successfully.');
    }

    public function update(Request $request, CashAccount $cashAccount)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'type'     => 'required|in:bank,cash',
            'balance'  => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'notes'    => 'nullable|string',
        ]);

        $cashAccount->update($validated);

        return redirect()->route('admin.cash-accounts')->with('success', 'Account updated successfully.');
    }

    public function destroy(CashAccount $cashAccount)
    {
        $cashAccount->delete();

        return redirect()->route('admin.cash-accounts')->with('success', 'Account deleted.');
    }
}
