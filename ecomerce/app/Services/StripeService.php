<?php
namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createCheckoutSession(array $items, int $orderId): Session
    {
        $lineItems = array_values(array_map(fn($item) => [
            'price_data' => [
                'currency'     => 'mad',
                'product_data' => [
                    'name' => $item['name'],
                ],
                'unit_amount'  => (int) ($item['price'] * 100), // centimes
            ],
            'quantity' => $item['quantity'],
        ], $items));

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => route('order.success') . '?order_id=' . $orderId,
            'cancel_url'           => route('order.checkout'),
        ]);
    }
}