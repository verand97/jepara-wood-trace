<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::with('artist')->latest()->get();
        $totalProducts = $products->count();
        $outOfStock = $products->where('stock', '<=', 0)->count();
        $totalArtists = Artist::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('products', 'totalProducts', 'outOfStock', 'totalArtists', 'totalOrders'));
    }

    public function orders()
    {
        $orders = Order::with(['orderItems.product'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function editOrder(string $id)
    {
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);
        
        $availableStatuses = [
            'pending' => 'Menunggu Pembayaran',
            'PAID_MOCK' => 'Lunas (Menunggu Diproses)',
            'processing' => 'Sedang Diproses/Dikemas',
            'shipped' => 'Sedang Diantar (Jasa Pengiriman)',
            'delivered' => 'Pesanan Selesai (Tiba di Tujuan)',
            'cancelled' => 'Dibatalkan'
        ];

        return view('admin.orders_edit', compact('order', 'availableStatuses'));
    }

    public function updateOrder(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroyOrder(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return redirect()->route('admin.orders')->with('success', 'Data pesanan berhasil dihapus.');
    }

    public function create()
    {
        $artists = Artist::all();
        return view('admin.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'production_method' => 'required|in:Hand-Carved,CNC-Assisted',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $images = [];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $images[] = $filename;
        }

        $artist = Artist::firstOrCreate(['name' => $request->artist_name]);

        Product::create([
            'title' => $request->title,
            'artist_id' => $artist->id,
            'price' => $request->price,
            'stock' => $request->stock,
            'production_method' => $request->production_method,
            'svlk_certificate_number' => $request->svlk_certificate_number,
            'description' => $request->description,
            'images' => empty($images) ? null : $images,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $artists = Artist::all();
        return view('admin.edit', compact('product', 'artists'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'production_method' => 'required|in:Hand-Carved,CNC-Assisted',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $images = $product->images ?? [];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $images = [$filename]; // Replace old image or append based on requirements (replacing here for simplicity)
        }

        $artist = Artist::firstOrCreate(['name' => $request->artist_name]);

        $product->update([
            'title' => $request->title,
            'artist_id' => $artist->id,
            'price' => $request->price,
            'stock' => $request->stock,
            'production_method' => $request->production_method,
            'svlk_certificate_number' => $request->svlk_certificate_number,
            'description' => $request->description,
            'images' => empty($images) ? null : $images,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
