<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display list of products
     */
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', fn($q) =>
                $q->where('name', $request->category)
            );
        }

        $products   = $query->paginate(9)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }  
     /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store product
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

   
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

   
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

   
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}