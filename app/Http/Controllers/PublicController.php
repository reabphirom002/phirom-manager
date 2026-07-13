<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Beverage;
use App\Models\Lesson;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    // === ទំព័រមុខសាធារណៈ (Public Frontends) ===

    public function computers() {
        $products = Product::latest()->take(12)->get();
        return view('welcome', compact('products'));
    }

    public function school() {
        return view('welcome');
    }

    public function cafe() {
        return view('welcome');
    }

    public function library() {
        return view('welcome');
    }

    // === ផ្ទាំងគ្រប់គ្រងចម្បង + ប្រព័ន្ធវិភាគ និងស្វែងរកទិន្នន័យឆ្លាតវៃ ===
    public function dashboard(Request $request)
    {
        // ១. គណនាស្ថិតិសកលសម្រាប់បង្ហាញលើ Analytics Dashboard
        $totalProducts = Product::sum('qty');
        $totalProductValue = Product::sum(DB::raw('qty * selling_price'));
        $totalClasses = Classroom::where('status', 'active')->count();
        $totalLessons = Lesson::count();

        // ២. ប្រព័ន្ធស្វែងរកឆ្លាតវៃសកល (Global Intelligent Search)
        $search = $request->input('search');
        $searchResults = [];

        if ($search) {
            // ស្វែងរកក្នុងតារាងកុំព្យូទ័រ
            $searchResults['products'] = Product::where('name', 'like', "%{$search}%")
                                                ->orWhere('brand', 'like', "%{$search}%")
                                                ->take(5)->get();

            // ស្វែងរកក្នុងតារាងភេសជ្ជៈ
            $searchResults['beverages'] = Beverage::where('name', 'like', "%{$search}%")
                                                  ->take(5)->get();

            // ស្វែងរកក្នុងតារាងមេរៀន
            $searchResults['lessons'] = Lesson::where('title', 'like', "%{$search}%")
                                              ->take(5)->get();

            // ស្វែងរកក្នុងតារាងសិស្ស
            $searchResults['students'] = Student::where('name', 'like', "%{$search}%")
                                                ->orWhere('email', 'like', "%{$search}%")
                                                ->take(5)->get();
        }

        return view('dashboard', compact(
            'totalProducts', 
            'totalProductValue', 
            'totalClasses', 
            'totalLessons', 
            'searchResults', 
            'search'
        ));
    }

    // === ផ្ទាំងគ្រប់គ្រងដាច់ដោយឡែករបស់ Workspace នីមួយៗ ===

    public function workspaceComputers()
    {
        $products = Product::latest()->get();
        $totalProducts = $products->sum('qty');
        $totalInvestment = $products->sum(fn($p) => $p->qty * $p->buying_price);
        $expectedRevenue = $products->sum(fn($p) => $p->qty * $p->selling_price);

        return view('workspaces.computers', compact('products', 'totalProducts', 'totalInvestment', 'expectedRevenue'));
    }

    public function workspaceSchool()
    {
        $classrooms = Classroom::with('course')->latest()->get();
        // គណនាស្ថិតិថ្នាក់រៀន
        $totalClasses = $classrooms->count();
        $activeClasses = $classrooms->where('status', 'active')->count();

        return view('workspaces.school', compact('classrooms', 'totalClasses', 'activeClasses'));
    }

    public function workspaceCafe()
    {
        $beverages = Beverage::with('category')->latest()->get();
        $totalBeverages = $beverages->count();
        $averagePrice = $beverages->avg('price') ?? 0.00;

        return view('workspaces.cafe', compact('beverages', 'totalBeverages', 'averagePrice'));
    }

    public function workspaceLibrary()
    {
        $lessons = Lesson::with('category')->latest()->get();
        $totalLessons = $lessons->count();
        
        return view('workspaces.library', compact('lessons', 'totalLessons'));
    }
}