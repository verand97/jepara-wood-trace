<x-layout>
    <x-slot:title>Riwayat Pesanan | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-earth-900 mb-2">Riwayat Pesanan Saya</h1>
        <p class="text-earth-600 mb-8">Daftar mahakarya Jepara yang telah Anda beli.</p>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-2xl border border-earth-200 shadow-sm overflow-hidden">
                        <div class="bg-earth-50 px-6 py-4 border-b border-earth-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <div class="text-xs text-earth-500 font-bold uppercase mb-1">ID Pesanan</div>
                                <div class="font-bold text-earth-900">#JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-earth-500 font-bold uppercase mb-1">Tanggal</div>
                                <div class="font-medium text-earth-800">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-earth-500 font-bold uppercase mb-1">Total Tagihan</div>
                                <div class="font-bold text-earth-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</div>
                            </div>
                            <div>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wide">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-earth-800 mb-4 border-b border-earth-100 pb-2">Item yang Dibeli:</h3>
                            <div class="space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-earth-100 rounded-lg overflow-hidden border border-earth-200 shrink-0">
                                            @php
                                                $product = $item->product;
                                                $imageUrl = null;
                                                if($product) {
                                                    if(is_array($product->images) && count($product->images) > 0) {
                                                        $imageUrl = asset('images/products/' . $product->images[0]);
                                                    } elseif(file_exists(public_path('images/products/' . $product->id . '.jpg'))) {
                                                        $imageUrl = asset('images/products/' . $product->id . '.jpg');
                                                    }
                                                }
                                            @endphp
                                            @if($imageUrl)
                                                <img src="{{ $imageUrl }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-earth-400">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="font-bold text-earth-900">{{ $product ? $product->title : 'Produk Tidak Tersedia' }}</div>
                                            <div class="text-sm text-earth-600">IDR {{ number_format($item->price, 0) }} &times; {{ $item->quantity }}</div>
                                        </div>
                                        <div class="font-bold text-earth-800">
                                            IDR {{ number_format($item->price * $item->quantity, 0) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-earth-200 shadow-xl">
                <div class="w-24 h-24 bg-earth-100 rounded-full flex items-center justify-center mx-auto mb-6 text-earth-400">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-earth-900 mb-4">Belum Ada Pesanan</h2>
                <p class="text-earth-600 mb-8">Anda belum melakukan pembelian karya seni apa pun. Silakan jelajahi galeri kami.</p>
                <a href="{{ route('gallery.index') }}" class="px-8 py-3 bg-earth-900 text-earth-100 rounded-lg font-bold hover:bg-black transition shadow-lg inline-block">Mulai Belanja</a>
            </div>
        @endif
    </div>
</x-layout>
