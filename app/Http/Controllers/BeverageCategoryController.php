<?php

namespace App\Http\Controllers;

use App\Models\BeverageCategory;
use Illuminate\Http\Request;

class BeverageCategoryController extends Controller
{
    public function index()
    {
        $categories = BeverageCategory::latest()->get();
        return view('beverage_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:beverage_categories,name']);
        BeverageCategory::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Beverage Category created successfully.');
    }

    public function update(Request $request, BeverageCategory $beverageCategory)
    {
        $request->validate(['name' => 'required|string|max:255|unique:beverage_categories,name,' . $beverageCategory->id]);
        $beverageCategory->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Beverage Category updated successfully.');
    }

    public function destroy(BeverageCategory $beverageCategory)
    {
        $beverageCategory->delete();
        return redirect()->back()->with('success', 'Beverage Category deleted successfully.');
    }
}