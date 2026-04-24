<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $featured_cars = Car::where('is_featured', true)->with(['company', 'location'])->take(6)->get();
        $recent_posts  = Post::where('status', 'published')->latest()->take(3)->get();

        return view('user.dashboard', compact('featured_cars', 'recent_posts'));
    }
}
