<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history()
    {
        // Mock user ID 1 for now
        $userId = \Illuminate\Support\Facades\Auth::id() ?? 1;
        
        $orders = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();
            
        return view('orders.history', compact('orders'));
    }

    public function show(string $id)
    {
        $userId = \Illuminate\Support\Facades\Auth::id() ?? 1;
        
        $order = Order::with(['orderItems.product.artist'])->where('user_id', $userId)->findOrFail($id);
        
        return view('orders.show', compact('order'));
    }
}
