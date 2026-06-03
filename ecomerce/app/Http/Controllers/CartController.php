<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        return view('cart.index', [
            'items' => $this->cart->get(),
            'total' => $this->cart->total(),
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->input('quantity', 1));

        if ($product->stock < $qty) {
            return back()->with('error', "Stock insuffisant ({$product->stock} disponibles)");
        }

        $this->cart->add($product->id, $product->name, $product->price, $qty);

        return back()->with('success', "{$product->name} ajouté au panier ✓");
    }

    public function update(Request $request, int $productId)
    {
        $qty     = max(1, (int) $request->input('quantity', 1));
        $product = Product::findOrFail($productId);

        if ($product->stock < $qty) {
            return back()->with('error', "Stock insuffisant ({$product->stock} disponibles)");
        }

        $this->cart->update($productId, $qty);

        return back()->with('success', 'Panier mis à jour');
    }

    public function remove(int $productId)
    {
        $this->cart->remove($productId);

        return back()->with('success', 'Produit retiré');
    }
}