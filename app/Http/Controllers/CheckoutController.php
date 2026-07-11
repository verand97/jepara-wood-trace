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
            'status' => 'PAID_MOCK', 
            'svlk_verification_status' => 'PENDING',
            'payment_gateway' => $request->payment_method ?? 'midtrans',
            'payment_id' => 'mock_txn_' . uniqid(),
            'shipping_address' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => 'Jalan Mock 123'
            ]
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
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
