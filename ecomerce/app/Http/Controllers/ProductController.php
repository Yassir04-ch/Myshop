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

        // create product without images
        $product = Product::create($validated);

        // store multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('productsadmin')->with('success', 'Produit créé avec succès');
    }

   
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.update', compact('product', 'categories'));
    }

   
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'reward_points' => 'required|integer',
            'cost_points' => 'required|integer',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'reward_points' => $validated['reward_points'],
            'cost_points' => $validated['cost_points'],
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()
            ->route('productsadmin')
            ->with('success', 'Produit modifié avec succès');
    }

   
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    
}