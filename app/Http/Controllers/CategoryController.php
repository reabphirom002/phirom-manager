<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // បង្ហាញបញ្ជី និង Form បង្កើតក្នុងទំព័រតែមួយ
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    // រក្សាទុកវគ្គសិក្សាថ្មី
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name']);
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    // លុបវគ្គសិក្សា
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}