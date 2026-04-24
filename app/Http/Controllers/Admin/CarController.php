<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarColor;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::with(['company', 'type', 'color', 'location']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->type_id);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->filled('color_id')) {
            $query->where('color_id', $request->color_id);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $cars      = $query->latest()->paginate(15);
        $companies = Company::all();
        $types     = CarType::all();
        $colors    = CarColor::all();
        $locations = Location::all();

        $counts = [
            'all'           => Car::count(),
            'new_purchased' => Car::where('status', 'new_purchased')->count(),
            'on_way'        => Car::where('status', 'on_way')->count(),
            'reached'       => Car::where('status', 'reached')->count(),
            'unpaid'        => Car::where('status', 'unpaid')->count(),
            'sold'          => Car::where('status', 'sold')->count(),
            'unsold'        => Car::where('status', 'unsold')->count(),
        ];

        return view('admin.cars', compact('cars', 'companies', 'types', 'colors', 'locations', 'counts'));
    }

    /**
     * Show the form for editing the specified car (JSON response for AJAX)
     */
    public function edit(Car $car)
    {
        return response()->json($car);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'company_id'    => 'nullable|exists:companies,id',
            'vin'           => 'nullable|string|max:50|unique:cars,vin',
            'lot_number'    => 'nullable|string|max:100',
            'year'          => 'required|integer|min:1990|max:2030',
            'type_id'       => 'nullable|exists:car_types,id',
            'color_id'      => 'nullable|exists:car_colors,id',
            'mileage'       => 'nullable|string',
            'purchase_cost' => 'required|numeric|min:0',
            'sale_price'    => 'required|numeric|min:0',
            'location_id'   => 'nullable|exists:locations,id',
            'status'        => 'required|in:new_purchased,on_way,reached,unpaid,sold,unsold',
            'fuel_type'     => 'nullable|string',
            'transmission'  => 'nullable|string',
            'notes'         => 'nullable|string',
            'is_featured'   => 'boolean',
            'image'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car = Car::create($validated);

        return redirect()->route('admin.cars')->with('success', 'Car added successfully.');
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'company_id'    => 'nullable|exists:companies,id',
            'vin'           => 'nullable|string|max:50|unique:cars,vin,' . $car->id,
            'lot_number'    => 'nullable|string|max:100',
            'year'          => 'required|integer|min:1990|max:2030',
            'type_id'       => 'nullable|exists:car_types,id',
            'color_id'      => 'nullable|exists:car_colors,id',
            'mileage'       => 'nullable|string',
            'purchase_cost' => 'required|numeric|min:0',
            'sale_price'    => 'required|numeric|min:0',
            'location_id'   => 'nullable|exists:locations,id',
            'status'        => 'required|in:new_purchased,on_way,reached,unpaid,sold,unsold',
            'fuel_type'     => 'nullable|string',
            'transmission'  => 'nullable|string',
            'notes'         => 'nullable|string',
            'is_featured'   => 'boolean',
            'image'         => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('admin.cars')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();

        return redirect()->route('admin.cars')->with('success', 'Car deleted successfully.');
    }
}