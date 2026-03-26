<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Location;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::where('status', 'active')
            ->with(['category', 'location'])
            ->latest()
            ->take(6)
            ->get();
            
        $categories = Category::all();
        $locations = Location::all();

        return view('welcome', compact('tours', 'categories', 'locations'));
    }

    public function showTour($id)
    {
        $tour = Tour::with(['category', 'location', 'schedules'])->findOrFail($id);
        return view('tours.show', compact('tour'));
    }
}
