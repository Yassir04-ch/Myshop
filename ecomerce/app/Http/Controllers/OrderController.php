<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(
        protected CartService  $cart,
        protected OrderService $orderService
    ) {}

    public function checkout()
    {
        $items = $this->cart->get();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide');
        }

        return view('order.checkout', [
            'items' => $items,
            'total' => $this->cart->total(),
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Connectez-vous d\'abord');
        }

        $request->validate([
            'payment_method' => 'required|in:cart,livraison',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'postal_code'    => 'required|string|max:10',
        ]);

        if (empty($this->cart->get())) {
            return redirect()->route('cart.index')->with('error', 'Panier vide');
        }

        $error = $this->orderService->validateStock();
        if ($error) {
            return back()->with('error', $error);
        }

        $order = $this->orderService->createOrder(
            Auth::id(),
            $request->payment_method,
            $request->address,
            $request->city,
            $request->postal_code,
        );

        if ($request->payment_method === 'cart') {
            $stripeUrl = $this->orderService->createStripeSession($order);
            return redirect($stripeUrl);
        }

        return redirect()->route('order.success')->with('success', 'Commande passée avec succès 🎉');
    }

    public function success(Request $request)
    {
        if ($request->has('order_id')) {
            $order = Order::where('id', $request->order_id)
                ->where('user_id', Auth::id())
                ->first();

            if ($order) {
                $order->update(['status' => 'processing']);
                $order->payment()->update(['status' => 'paid']);
            }
        }

        return view('order.success');
    }

    public function myOrders()
    {
        $orders = Order::with(['items.product', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('order.my-orders', compact('orders'));
    }
}