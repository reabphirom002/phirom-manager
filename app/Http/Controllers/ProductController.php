<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // នាំចូល Storage

class ProductController extends Controller
{
    // ១. បង្ហាញរបាយការណ៍សង្ខេប និងបញ្ជីទំនិញទាំងអស់
    // ១. បង្ហាញរបាយការណ៍សង្ខេប និងបញ្ជីទំនិញទាំងអស់ (បែងចែកទំព័រ)
    public function index()
    {
        // កូដពិសេស៖ ទាញយកផលិតផលទាំងអស់ដើម្បីគណនាលំនាំស្ថិតិឃ្លាំងសរុប (ការពារកុំឱ្យលទ្ធផលស្ថិតិខុសពេលប្ដូរទំព័រ)
        $allProducts = Product::all();

        $totalProducts = $allProducts->sum('qty');
        $totalInvestment = $allProducts->sum(function($product) {
            return $product->qty * $product->buying_price;
        });
        $expectedRevenue = $allProducts->sum(function($product) {
            return $product->qty * $product->selling_price;
        });
        
        $lowStockCount = $allProducts->where('qty', '>', 0)->where('qty', '<=', 5)->count();

        // ទាញយកផលិតផលដោយបែងចែកទំព័រ (Paginate) ៥ គ្រឿងក្នុងមួយទំព័រសម្រាប់បង្ហាញក្នុងតារាង
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products', 'totalProducts', 'totalInvestment', 'expectedRevenue', 'lowStockCount'));
    }

    // ២. បង្ហាញទំព័រ Form បន្ថែមទំនិញថ្មី
    public function create()
    {
        return view('products.create');
    }

    // ៣. រក្សាទុកទំនិញថ្មីចូល Database (MySQL)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'specs' => 'nullable|string',
            'qty' => 'required|integer|min:0',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'warranty' => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120', 
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->specs = $request->specs;
        $product->qty = $request->qty;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->warranty = $request->warranty;
        $product->description = $request->description;

        // ដំណើរការរក្សាទុកទិន្នន័យរូបភាព ២ ជម្រើស
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $product->image_url = 'storage/' . $path;
        } else {
            $product->image_url = $request->image_url;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', __('messages.product_saved'));
    }

    // ៤. បង្ហាញទំព័រកែសម្រួលព័ត៌មានទំនិញ
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // ៥. ធ្វើបច្ចុប្បន្នភាពព័ត៌មានទំនិញ (Update - កែសម្រួលថ្មីជួសជុលបញ្ហា MassAssignment)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'specs' => 'nullable|string',
            'qty' => 'required|integer|min:0',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'warranty' => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'image_url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        // កំណត់តម្លៃចំៗនីមួយៗម្ដងមួយៗ (ការពារ និងដោះស្រាយកំហុស MassAssignmentException ទាំងស្រុង)
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->specs = $request->specs;
        $product->qty = $request->qty;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->warranty = $request->warranty;
        $product->description = $request->description;

        // ដំណើរការផ្លាស់ប្ដូររូបភាពថ្មី និងជួយលុបរូបភាពចាស់ចេញពីម៉ាស៊ីនកុំព្យូទ័ររបស់អ្នក
        if ($request->hasFile('image_file')) {
            if ($product->image_url && !str_contains($product->image_url, 'http')) {
                $oldPath = str_replace('storage/', '', $product->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('image_file')->store('products', 'public');
            $product->image_url = 'storage/' . $path;
        } elseif ($request->image_url) {
            if ($product->image_url && !str_contains($product->image_url, 'http')) {
                $oldPath = str_replace('storage/', '', $product->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $product->image_url = $request->image_url;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', __('messages.product_updated'));
    }

    // ៦. លុបទំនិញចេញពីស្តុក
    public function destroy(Product $product)
    {
        if ($product->image_url && !str_contains($product->image_url, 'http')) {
            $oldPath = str_replace('storage/', '', $product->image_url);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }
        
        $product->delete();

        return redirect()->route('products.index')->with('success', __('messages.product_deleted'));
    }
}