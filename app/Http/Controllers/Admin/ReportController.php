<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year  = $request->get('year', date('Y'));
        $month = $request->get('month');

        $salesQuery    = Sale::query();
        $expenseQuery  = Expense::query();

        if ($month) {
            $salesQuery->whereYear('sale_date', $year)->whereMonth('sale_date', $month);
            $expenseQuery->whereYear('expense_date', $year)->whereMonth('expense_date', $month);
        } else {
            $salesQuery->whereYear('sale_date', $year);
            $expenseQuery->whereYear('expense_date', $year);
        }

        $total_sales    = $salesQuery->sum('sale_price');
        $total_expenses = $expenseQuery->sum('amount');
        $net_profit     = $total_sales - $total_expenses;

        $cars_sold   = Car::where('status', 'sold')->count();
        $cars_unsold = Car::where('status', '!=', 'sold')->count();

        $monthly_sales = Sale::selectRaw('MONTH(sale_date) as month, SUM(sale_price) as total')
            ->whereYear('sale_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('admin.reports', compact(
            'total_sales', 'total_expenses', 'net_profit',
            'cars_sold', 'cars_unsold', 'monthly_sales', 'year', 'month'
        ));
    }
}
