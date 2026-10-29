<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = collect($cart)->sum(
            fn ($item) => $item['price'] * $item['quantity']
        );

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        if (!$product->is_available || $product->stock < 1) {
            return back()->with('error', 'Produk sedang tidak tersedia.');
        }

        $cart = session('cart', []);
        $quantity = (int) $request->quantity;
        $current = $cart[$product->id]['quantity'] ?? 0;

        if ($current + $quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => (float) $product->price,
            'quantity' => $current + $quantity,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $cart = session('cart', []);
        $product = Product::findOrFail($id);
        $quantity = (int) $request->quantity;

        if (!isset($cart[$id])) {
            return redirect()->route('cart.index');
        }

        if ($quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$id]['quantity'] = $quantity;
        session(['cart' => $cart]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(int $id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
