<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $qty = max(1, (int) $request->input('quantity', 1));
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $qty;
            } else {
                $cart[$id] = [
                    "name"      => $product->title,
                    "quantity"  => $qty,
                    "price"     => $product->price,
                    "currency"  => $product->currency,
                    "artist_id" => $product->artist_id
                ];
            }

            session()->put('cart', $cart);
            Log::info('Cart add success', ['product_id' => $id, 'qty' => $qty, 'cart_count' => count($cart)]);
            return redirect()->route('cart.index')->with('success', "{$qty}x \"{$product->title}\" berhasil ditambahkan ke keranjang!");
        } catch (\Exception $e) {
            Log::error('Cart add error', ['error' => $e->getMessage(), 'product_id' => $id]);
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function remove(string $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong!');
        }
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'total'));
    }
}
