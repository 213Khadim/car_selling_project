<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featured_cars = Car::with(['company', 'color', 'type', 'location'])
            ->where('status', '!=', 'sold')
            ->where('is_featured', true)
            ->take(8)
            ->get();

        $recent_cars = Car::with(['company', 'color', 'type'])
            ->where('status', '!=', 'sold')
            ->latest()
            ->take(6)
            ->get();

        $brands = Company::withCount('cars')->having('cars_count', '>', 0)->get();

        $recent_posts = Post::where('status', 'published')->latest()->take(3)->get();

        $stats = [
            'total_cars'   => Car::where('status', '!=', 'sold')->count(),
            'sold_cars'    => Car::where('status', 'sold')->count(),
            'brands'       => Company::count(),
        ];

        return view('home', compact('featured_cars', 'recent_cars', 'brands', 'recent_posts', 'stats'));
    }
}
