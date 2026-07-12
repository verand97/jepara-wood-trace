<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('gallery.index')->with('error', 'Keranjang kosong!');
        }

        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Mock Order Creation (Simulating successful Stripe/Midtrans integration step)
        $order = Order::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id() ?? 1, 
            'total_amount' => $totalAmount,
            'currency' => 'IDR',
            'status' => 'paid', 
            'svlk_verification_status' => 'pending',
            'payment_gateway' => $request->payment_method ?? 'midtrans',
            'payment_id' => 'TRX-' . strtoupper(\Illuminate\Support\Str::random(12)),
            'shipping_address' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'phone' => $request->phone ?? null,
                'email' => collect($cart)->first()['user_email'] ?? auth()->user()->email ?? null,
            ]
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
            
            // Kurangi stok produk
            \App\Models\Product::where('id', $id)->decrement('stock', $item['quantity']);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(string $id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('checkout.success', compact('order'));
    }
}
