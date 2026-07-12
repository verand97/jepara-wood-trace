<x-layout>
    <x-slot:title>Detail Pesanan #JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} | Jepara Wood-Trace</x-slot:title>

    <style>
        .os-header-bar {
            background-color: #2b261f; /* earth-900 */
            color: #ffffff;
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .os-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        .os-grid-3 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2.5rem;
        }
        .os-status-badge {
            display: inline-block;
            background-color: #ffffff;
            color: #2b261f;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 1.125rem;
            text-transform: uppercase;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 1024px) {
            .os-grid-4 { grid-template-columns: repeat(2, 1fr); }
            .os-grid-3 { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .os-header-bar { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .os-grid-4 { grid-template-columns: 1fr; }
        }
    </style>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('orders.history') }}" class="text-earth-500 hover:text-earth-800 flex items-center text-sm font-medium transition inline-flex">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Riwayat Pesanan
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-earth-200 shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="os-header-bar">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Detail Pesanan</h1>
                    <p class="text-earth-300 font-mono text-lg m-0" style="color: #d4cfc4;">#JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div style="text-align: right;">
                    <div class="text-sm mb-1 uppercase tracking-wider font-bold" style="color: #d4cfc4;">Status Pesanan</div>
                    <span class="os-status-badge">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <div style="padding: 2rem;">
                <!-- Transaction Info Grid -->
                <div class="os-grid-4 mb-10 pb-10 border-b border-earth-100" style="margin-bottom: 2.5rem; padding-bottom: 2.5rem;">
                    <div>
                        <div class="text-xs text-earth-500 font-bold uppercase mb-1">Tanggal Transaksi</div>
                        <div class="font-medium text-earth-900">{{ $order->created_at->format('d F Y, H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-earth-500 font-bold uppercase mb-1">ID Transaksi (Gateway)</div>
                        <div class="font-medium text-earth-900" style="word-break: break-all;">{{ $order->transaction_id ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-earth-500 font-bold uppercase mb-1">Metode Pembayaran</div>
                        <div class="font-medium text-earth-900 uppercase">{{ $order->payment_method ?? 'Transfer Bank' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-earth-500 font-bold uppercase mb-1">Total Tagihan</div>
                        <div class="font-bold text-2xl text-earth-900">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</div>
                    </div>
                </div>

                <div class="os-grid-3">
                    <!-- Left Column: Items -->
                    <div>
                        <h3 class="text-xl font-bold text-earth-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-earth-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Item yang Dibeli
                        </h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center gap-6 rounded-xl border border-earth-100 bg-earth-50 hover:shadow-md transition-shadow" style="padding: 1rem;">
                                    <div class="bg-white rounded-lg overflow-hidden border border-earth-200 shrink-0" style="width: 6rem; height: 6rem;">
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
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-bold text-lg text-earth-900 mb-1">{{ $product ? $product->title : 'Produk Tidak Tersedia' }}</div>
                                        @if($product && $product->artist)
                                            <div class="text-sm text-earth-600 mb-1">Karya: {{ $product->artist->name }}</div>
                                        @endif
                                        @if($product && $product->svlk_certificate_number)
                                            <div class="inline-flex items-center gap-1 text-xs font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded border border-green-200 mt-1 mb-2">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                SVLK: {{ $product->svlk_certificate_number }}
                                            </div>
                                        @endif
                                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-earth-200">
                                            <div class="text-earth-600 font-medium">IDR {{ number_format($item->price, 0) }} <span class="mx-2">&times;</span> {{ $item->quantity }}</div>
                                            <div class="font-bold text-earth-900 text-lg">IDR {{ number_format($item->price * $item->quantity, 0) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right Column: Shipping Details -->
                    <div>
                        <h3 class="text-xl font-bold text-earth-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-earth-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Informasi Pengiriman
                        </h3>
                        
                        <div class="bg-earth-50 rounded-xl border border-earth-100 p-6" style="display: flex; flex-direction: column; gap: 1rem;">
                            @php
                                $shipping = is_string($order->shipping_address) ? json_decode($order->shipping_address, true) : $order->shipping_address;
                            @endphp

                            @if(is_array($shipping) && !empty($shipping))
                                <div>
                                    <div class="text-xs text-earth-500 font-bold uppercase mb-1">Penerima</div>
                                    <div class="font-bold text-earth-900">{{ $shipping['first_name'] ?? '' }} {{ $shipping['last_name'] ?? '' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-earth-500 font-bold uppercase mb-1">Kontak</div>
                                    <div class="font-medium text-earth-900">{{ $shipping['email'] ?? '-' }}</div>
                                    <div class="font-medium text-earth-900">{{ $shipping['phone'] ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-earth-500 font-bold uppercase mb-1">Alamat Lengkap</div>
                                    <div class="font-medium text-earth-900">
                                        {{ $shipping['address'] ?? '-' }}<br>
                                        {{ $shipping['city'] ?? '' }}, {{ $shipping['state'] ?? '' }}<br>
                                        {{ $shipping['country'] ?? '' }} - {{ $shipping['zip_code'] ?? '' }}
                                    </div>
                                </div>
                                
                                @if(!empty($shipping['notes']))
                                <div class="pt-4 border-t border-earth-200 mt-4">
                                    <div class="text-xs text-earth-500 font-bold uppercase mb-1">Catatan Tambahan</div>
                                    <div class="font-medium text-earth-800 italic">"{{ $shipping['notes'] }}"</div>
                                </div>
                                @endif
                            @else
                                <div class="text-earth-500 italic">Informasi pengiriman tidak tersedia atau menggunakan data legacy.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
