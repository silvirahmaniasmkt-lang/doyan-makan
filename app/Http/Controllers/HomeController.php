<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('home', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        return view('products.show', compact('product'));
    }
}
