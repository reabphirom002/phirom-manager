<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\BeverageCategory; // នាំចូល Model ថ្មី
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeverageController extends Controller
{
    public function index()
    {
        $allBeverages = Beverage::all();
        $totalBeverages = $allBeverages->count();
        $averagePrice = $allBeverages->avg('price') ?? 0.00;
        
        // ទាញយកក្រុមប្រភេទដើម្បីបង្កើត Tabs ស្អាតៗ
        $categories = BeverageCategory::all();
        $categoriesCount = $categories->count();

        // ដំណើរការ Paginate 6 គ្រឿង
        $beveragesPaginated = Beverage::with('category')->latest()->paginate(6);

        return view('beverages.index', compact('categories', 'beveragesPaginated', 'totalBeverages', 'averagePrice', 'categoriesCount'));
    }

    public function create()
    {
        $categories = BeverageCategory::all();
        return view('beverages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'beverage_category_id' => 'required|exists:beverage_categories,id', // ឆែកមើលក្នុងតារាងថ្មី
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'image_url' => 'nullable|url',
            'recipe' => 'nullable|string',
        ]);

        $beverage = new Beverage();
        $beverage->name = $request->name;
        $beverage->beverage_category_id = $request->beverage_category_id;
        $beverage->price = $request->price;
        $beverage->recipe = $request->recipe;

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('beverages', 'public');
            $beverage->image_url = 'storage/' . $path;
        } else {
            $beverage->image_url = $request->image_url;
        }

        $beverage->save();

        return redirect()->route('beverages.index')->with('success', __('messages.beverage_saved'));
    }

    public function edit(Beverage $beverage)
    {
        $categories = BeverageCategory::all();
        return view('beverages.edit', compact('beverage', 'categories'));
    }

    public function update(Request $request, Beverage $beverage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'beverage_category_id' => 'required|exists:beverage_categories,id',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'image_url' => 'nullable|url',
            'recipe' => 'nullable|string',
        ]);

        $beverage->name = $request->name;
        $beverage->beverage_category_id = $request->beverage_category_id;
        $beverage->price = $request->price;
        $beverage->recipe = $request->recipe;

        if ($request->hasFile('image_file')) {
            if ($beverage->image_url && !str_contains($beverage->image_url, 'http')) {
                $oldPath = str_replace('storage/', '', $beverage->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('image_file')->store('beverages', 'public');
            $beverage->image_url = 'storage/' . $path;
        } elseif ($request->image_url) {
            if ($beverage->image_url && !str_contains($beverage->image_url, 'http')) {
                $oldPath = str_replace('storage/', '', $beverage->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $beverage->image_url = $request->image_url;
        }

        $beverage->save();

        return redirect()->route('beverages.index')->with('success', __('messages.beverage_updated'));
    }

    public function destroy(Beverage $beverage)
    {
        if ($beverage->image_url && !str_contains($beverage->image_url, 'http')) {
            $oldPath = str_replace('storage/', '', $beverage->image_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        
        $beverage->delete();

        return redirect()->route('beverages.index')->with('success', __('messages.beverage_deleted'));
    }
}