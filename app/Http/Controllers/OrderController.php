<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function checkout()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kamu masih kosong.');
        }

        $total = collect($cart)->sum(
            fn ($item) => $item['price'] * $item['quantity']
        );

        return view('orders.checkout', compact('cart', 'total'));
    }

    /**
     * Menyimpan pesanan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:25',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ], [
            'customer_name.required' => 'Nama pemesan wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'address.required' => 'Alamat pengiriman wajib diisi.',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kamu masih kosong.');
        }

        $order = DB::transaction(function () use ($cart, $validated, $request) {
            $total = 0;
            $checkedItems = [];

            foreach ($cart as $item) {
                $product = Product::whereKey($item['product_id'])
                    ->lockForUpdate()
                    ->first();

                if (
                    !$product ||
                    !$product->is_available ||
                    $product->stock < $item['quantity']
                ) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok salah satu produk berubah. Periksa keranjang kamu.',
                    ]);
                }

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $checkedItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_code' => 'DM-' . strtoupper(Str::random(8)),
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'notes' => $validated['notes'] ?? null,
                'total_price' => $total,
                'status' => 'Menunggu',
            ]);

            foreach ($checkedItems as $item) {
                $product = $item['product'];

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $item['subtotal'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Menampilkan riwayat pesanan pengguna yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan milik pengguna.
     */
    public function show(Order $order)
    {
        abort_unless(
            (int) $order->user_id === (int) auth()->id(),
            403
        );

        $order->load('items');

        return view('orders.show', compact('order'));
    }
}
