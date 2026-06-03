<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ============================================
    // DASHBOARD
    // ============================================
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalOrders'   => Order::count(),
            'totalProducts' => Product::count(),
            'totalClients'  => User::where('role', 'client')->count(),
            'recentOrders'  => Order::with(['user', 'payment'])->latest()->take(5)->get(),
        ]);
    }

    // CLIENTS
    public function clients()
    {
        $clients = User::where('role', 'client')->latest()->get();
        return view('admin.clients', compact('clients'));
    }

    public function toggleClient(User $user)
    {

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Client {$user->name} {$status}");
    }

    // PRODUCTS
    public function products()
    {
        $products   = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.products', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.product-create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Produit créé avec succès');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.product-edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Produit mis à jour');
    }

    public function destroyProduct(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Produit supprimé');
    }

    // ORDERS
    public function orders()
    {
        $orders = Order::with(['user', 'items.product', 'payment'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour');
    }
}