<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create($request->only('name', 'description'));

        return back()->with('success', 'Catégorie créée avec succès ✓');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
        ]);

        $category->update($request->only('name', 'description'));

        return back()->with('success', 'Catégorie mise à jour ✓');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', "Impossible de supprimer — {$category->products_count} produit(s) lié(s)");
        }

        $category->delete();

        return back()->with('success', 'Catégorie supprimée ✓');
    }
}