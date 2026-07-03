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
// មុខងារពិសេស៖ ទទួលទិន្នន័យដើម្បីកែប្រែឈ្មោះវគ្គសិក្សា (Update)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // ត្រួតពិនិត្យថាឈ្មោះថ្មីមិនជាន់ជាមួយឈ្មោះចាស់ដទៃទៀតឡើយ (លើកលែងតែខ្លួនឯង)
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    // លុបវគ្គសិក្សា
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    
}