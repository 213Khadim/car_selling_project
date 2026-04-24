<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cars'      => Car::count(),
            'total_sales'     => Sale::sum('sale_price'),
            'total_customers' => Customer::count(),
            'total_expenses'  => Expense::sum('amount'),
        ];

        $recent_sales = Sale::with(['car', 'customer'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_sales'));
    }
}
