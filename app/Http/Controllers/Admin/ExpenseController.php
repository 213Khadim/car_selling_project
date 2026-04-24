<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $expenses   = $query->latest()->paginate(15);
        $categories = ExpenseCategory::all();
        $total      = Expense::sum('amount');

        return view('admin.expenses', compact('expenses', 'categories', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'nullable|exists:expense_categories,id',
            'amount'       => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes'        => 'nullable|string',
        ]);

        Expense::create($validated);

        return redirect()->route('admin.expenses')->with('success', 'Expense added successfully.');
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'nullable|exists:expense_categories,id',
            'amount'       => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'notes'        => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('admin.expenses')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('admin.expenses')->with('success', 'Expense deleted successfully.');
    }
}
