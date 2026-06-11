<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderMail;

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

        
        if ($request->payment_method === 'cart') 
        {
            $stripeUrl = $this->orderService->createStripeSession($order);
            
            foreach ($order->items as $item)
            {
                $user = Auth::user();
                $product = $item->product;
                if ($product) {
                    $user->increment('points', $product->reward_points * $item->quantity);
                 }
            }
                    return redirect($stripeUrl);
        }
                    
        Mail::to('yassirch245@gmail.com')->send(new NewOrderMail($order));
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
                            
                Mail::to('yassirch245@gmail.com')->send(new NewOrderMail($order));
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

    public function showOrder(Order $order)
    {
        $order->load(['user', 'items.product', 'payment']);
        return view('order.show', compact('order'));
    }

    public function buyWithPoints($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // check points
        if ($user->points < $product->cost_points) {
            return back()->with('error', 'Points insuffisants');
        }

        // decrement points
        $user->decrement('points', $product->cost_points);

        // create order
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => 'points',
            'total_amount' => 0,
            'status' => 'processing',
        ]);

        // create order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 0
        ]);

        // create payment
        Payment::create([
            'order_id' => $order->id,
            'amount' => $product->cost_points,
            'method' => 'points',
            'transaction_id' => 'PTS-' . strtoupper(uniqid()),
            'status' => 'paid'
        ]);

        return back()->with('success', 'Achat effectué avec succès via les points');
    }
}