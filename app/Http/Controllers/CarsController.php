<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarColor;
use App\Models\CarType;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with(['company', 'color', 'type', 'location'])
            ->where('status', '!=', 'sold');

        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
        }
        if ($request->filled('type')) {
            $query->where('type_id', $request->type);
        }
        if ($request->filled('color')) {
            $query->where('color_id', $request->color);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('min_price')) {
            $query->where('sale_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('sale_price', '<=', $request->max_price);
        }
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%$q%")
                    ->orWhereHas('company', fn ($c) => $c->where('name', 'like', "%$q%"));
            });
        }

        $cars      = $query->latest()->paginate(12);
        $companies = Company::all();
        $types     = CarType::all();
        $colors    = CarColor::all();

        return view('cars', compact('cars', 'companies', 'types', 'colors'));
    }

    public function show(Car $car)
    {
        $car->load(['company', 'color', 'type', 'location', 'images']);

        $related = Car::where('company_id', $car->company_id)
            ->where('id', '!=', $car->id)
            ->where('status', '!=', 'sold')
            ->take(4)
            ->get();

        return view('car-detail', compact('car', 'related'));
    }

    public function brands()
    {
        $companies = Company::withCount('cars')->get();

        return view('brands', compact('companies'));
    }
}
