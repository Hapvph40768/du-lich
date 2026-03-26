<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['category', 'location'])->latest()->paginate(10);
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.tours.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'nullable|integer|min:0',
            'duration_nights' => 'nullable|integer|min:0',
            'max_people' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string'
        ]);

        $tour = Tour::create($validated);
        
        if ($request->filled('image_urls')) {
            $urls = array_filter(array_map('trim', explode("\n", $request->input('image_urls'))));
            foreach ($urls as $url) {
                if (!empty($url)) $tour->images()->create(['image_url' => $url]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Tạo Tour thành công!');
    }

    public function edit(Tour $tour)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.tours.edit', compact('tour', 'categories', 'locations'));
    }

    public function update(Request $request, Tour $tour)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'nullable|integer|min:0',
            'duration_nights' => 'nullable|integer|min:0',
            'max_people' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string'
        ]);

        $tour->update($validated);
        
        if ($request->has('image_urls')) {
            $tour->images()->delete();
            $urls = array_filter(array_map('trim', explode("\n", $request->input('image_urls'))));
            foreach ($urls as $url) {
                if (!empty($url)) $tour->images()->create(['image_url' => $url]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Cập nhật Tour thành công!');
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Xóa Tour thành công!');
    }
}
