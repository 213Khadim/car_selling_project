<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashAccount;
use App\Models\CashTransfer;
use Illuminate\Http\Request;

class CashTransferController extends Controller
{
    public function index()
    {
        $transfers = CashTransfer::with(['fromAccount', 'toAccount'])->latest()->paginate(15);
        $accounts  = CashAccount::all();

        return view('admin.cash-transfer', compact('transfers', 'accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_account_id' => 'required|exists:cash_accounts,id',
            'to_account_id'   => 'required|exists:cash_accounts,id|different:from_account_id',
            'amount'          => 'required|numeric|min:0.01',
            'transfer_date'   => 'required|date',
            'notes'           => 'nullable|string',
        ]);

        $transfer = CashTransfer::create($validated);

        // Update account balances
        CashAccount::find($validated['from_account_id'])->decrement('balance', $validated['amount']);
        CashAccount::find($validated['to_account_id'])->increment('balance', $validated['amount']);

        return redirect()->route('admin.cash-transfer')->with('success', 'Transfer completed successfully.');
    }

    public function destroy(CashTransfer $cashTransfer)
    {
        // Reverse balances
        $cashTransfer->fromAccount->increment('balance', $cashTransfer->amount);
        $cashTransfer->toAccount->decrement('balance', $cashTransfer->amount);
        $cashTransfer->delete();

        return redirect()->route('admin.cash-transfer')->with('success', 'Transfer deleted.');
    }
}
