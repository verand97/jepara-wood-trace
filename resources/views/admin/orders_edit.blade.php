<x-admin-layout>
    <x-slot:title>Detail Pesanan | Admin Dashboard</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.orders') }}" class="text-earth-500 hover:text-earth-900 transition bg-white p-2 rounded-lg border border-earth-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <h1 class="text-3xl font-bold text-earth-900">Pesanan #JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
                </div>
                <p class="text-earth-600">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left Column: Status Form -->
            <div class="w-full md:w-1/3 space-y-6">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="bg-white rounded-3xl p-6 shadow-sm border border-earth-200">
                    @csrf
                    @method('PUT')
                    
                    <h2 class="text-lg font-bold text-earth-900 mb-4 border-b border-earth-100 pb-2">Status Pesanan</h2>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-earth-700 mb-2">Ubah Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border {{ $errors->has('status') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                            @foreach($availableStatuses as $key => $label)
                                <option value="{{ $key }}" {{ old('status', $order->status) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3 bg-earth-900 text-earth-100 rounded-xl font-bold hover:bg-black transition-colors shadow-md">
                        Simpan Status
                    </button>
                </form>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-earth-200">
                    <h2 class="text-lg font-bold text-earth-900 mb-4 border-b border-earth-100 pb-2">Informasi Pembeli</h2>
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="block text-earth-500 font-medium text-xs uppercase tracking-wider mb-1">Nama</span>
                            <span class="font-bold text-earth-800">{{ $order->shipping_address['first_name'] ?? 'Guest' }} {{ $order->shipping_address['last_name'] ?? '' }}</span>
                        </div>
                        <div>
                            <span class="block text-earth-500 font-medium text-xs uppercase tracking-wider mb-1">Email / Kontak</span>
                            <span class="font-medium text-earth-800">{{ $order->shipping_address['email'] ?? $order->user->email ?? '-' }}<br>{{ $order->shipping_address['phone'] ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-earth-500 font-medium text-xs uppercase tracking-wider mb-1">Alamat Pengiriman</span>
                            <span class="font-medium text-earth-800">
                                {{ $order->shipping_address['address'] ?? '-' }}<br>
                                {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                                {{ $order->shipping_address['country'] ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Items -->
            <div class="w-full md:w-2/3">
                <div class="bg-white rounded-3xl border border-earth-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-earth-100">
                        <h2 class="text-lg font-bold text-earth-900">Rincian Produk</h2>
                    </div>
                    
                    <div class="divide-y divide-earth-100">
                        @foreach($order->orderItems as $item)
                            <div class="p-6 flex items-center gap-4">
                                <div class="w-20 h-20 bg-earth-100 rounded-xl overflow-hidden shrink-0">
                                    @if($item->product && $item->product->images && count($item->product->images) > 0)
                                        <img src="{{ asset('images/products/' . $item->product->images[0]) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-earth-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-earth-900">{{ $item->product_name }}</h3>
                                    <p class="text-earth-500 text-sm">Qty: {{ $item->quantity }} &times; {{ $order->currency }} {{ number_format($item->price, 2) }}</p>
                                </div>
                                <div class="font-black text-earth-900 whitespace-nowrap text-right">
                                    {{ $order->currency }} {{ number_format($item->quantity * $item->price, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="p-6 bg-earth-50 border-t border-earth-200">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center text-lg font-black text-earth-900 gap-4">
                            <span>Total Pembayaran</span>
                            <span>{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="inline-block bg-white border border-earth-200 px-3 py-1 rounded text-xs font-bold text-earth-600 uppercase tracking-wider shadow-sm">
                                METODE: {{ $order->payment_gateway ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
