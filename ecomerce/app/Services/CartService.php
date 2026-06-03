<?php
namespace App\Services;

class CartService
{
    const KEY = 'cart';

    public function get(): array
    {
        return session(self::KEY, []);
    }

    public function add(int $productId, string $name, float $price, int $quantity): void
    {
        $cart = $this->get();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name'       => $name,
                'price'      => $price,
                'quantity'   => $quantity,
            ];
        }

        session([self::KEY => $cart]);
    }

    public function update(int $productId, int $quantity): void
    {
        $cart = $this->get();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session([self::KEY => $cart]);
        }
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        unset($cart[$productId]);
        session([self::KEY => $cart]);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function total(): float
    {
        return array_reduce($this->get(), fn($carry, $item) =>
            $carry + ($item['price'] * $item['quantity']), 0);
    }

    public function count(): int
    {
        return array_sum(array_column($this->get(), 'quantity'));
    }
}