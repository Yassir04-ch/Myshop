<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalOrders'   => Order::count(),
            'totalProducts' => Product::count(),
            'totalClients'  => User::whereHas('role', fn($q) => $q->where('name', 'client'))->count(),
            'recentOrders'  => Order::with(['user', 'payment'])->latest()->take(5)->get(),
        ]);
    }

    public function clients()
    {
        $clients = User::whereHas('role', fn($q) => $q->where('name', 'client'))
                    ->latest()
                    ->get();
        return view('admin.clients', compact('clients'));
    }

      public function activerClient(User $user)
    {
        $user->update(['is_active' => true]);

        return back()->with('success',"Client {$user->firstname} activé");
    }

    public function desactiverClient(User $user)
    {
        $user->update(['is_active' => false]);

        return back()->with('success',"Client {$user->firstname} désactivé");
    }

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
        
        if ($order->status ==='accepted')
        {

            $order->load('items.product', 'user');

            foreach ($order->items as $item) {

                if ($item->product) {

                    $order->user->increment(
                        'points',
                        $item->product->reward_points * $item->quantity
                    );
                }
            }
        }
        return back()->with('success', 'Statut mis à jour');
    }

    
}