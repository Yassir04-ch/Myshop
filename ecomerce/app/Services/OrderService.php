<?php
// app/Services/OrderService.php
namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;

class OrderService
{
    public function __construct(
        protected CartService   $cart,
        protected StripeService $stripe
    ) {}

    public function validateStock(): ?string
    {
        $items    = $this->cart->get();
        $products = Product::whereIn('id', array_keys($items))->get()->keyBy('id');

        foreach ($items as $productId => $item) {
            $product = $products[$productId] ?? null;

            if (!$product || $product->stock < $item['quantity']) {
                $available = $product ? $product->stock : 0;
                return "Stock insuffisant pour « {$item['name']} » — {$available} disponibles";
            }
        }

        return null;
    }

    public function createOrder(
        int    $userId,
        string $paymentMethod,
        string $address,
        string $city,
        string $postalCode
    ): Order {
        $items    = $this->cart->get();
        $products = Product::whereIn('id', array_keys($items))->get()->keyBy('id');

        $order = Order::create([
            'user_id'        => $userId,
            'total_amount'   => $this->cart->total(),
            'status'         => 'pending',
            'payment_method' => $paymentMethod,
            'address'        => $address,
            'city'           => $city,
            'postal_code'    => $postalCode,
        ]);

        foreach ($items as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);

            $products[$productId]->decrement('stock', $item['quantity']);
        }

        // خلق Payment record
        Payment::create([
            'order_id'       => $order->id,
            'amount'         => $this->cart->total(),
            'method'         => $paymentMethod,
            'transaction_id' => null,
            'status'         => 'pending',
        ]);

        $this->cart->clear();

        return $order;
    }

    public function createStripeSession(Order $order): string
    {
        $items = $order->items->map(fn($item) => [
            'name'     => $item->product->name,
            'price'    => $item->price,
            'quantity' => $item->quantity,
        ])->toArray();

        $session = $this->stripe->createCheckoutSession($items, $order->id);

        $order->payment()->update([
            'transaction_id' => $session->id,
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        return $session->url;
    }
}