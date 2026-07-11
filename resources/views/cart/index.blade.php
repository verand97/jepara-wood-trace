<x-layout>
    <x-slot:title>{{ __('Keranjang Belanja') }} | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-earth-900 mb-8">{{ __('Keranjang Belanja') }}</h1>

        @if(count($cart) > 0)
            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-earth-200 shadow-xl mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-earth-200 text-earth-500">
                                <th class="pb-4 font-semibold">{{ __('Produk') }}</th>
                                <th class="pb-4 font-semibold">{{ __('Harga') }}</th>
                                <th class="pb-4 font-semibold">{{ __('Kuantitas') }}</th>
                                <th class="pb-4 font-semibold text-right">{{ __('Subtotal') }}</th>
                                <th class="pb-4 font-semibold text-center">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-earth-800">
                            @foreach($cart as $id => $details)
                                <tr class="border-b border-earth-100 last:border-0 hover:bg-earth-100/50 transition">
                                    <td class="py-6 flex items-center gap-4">
                                        @php
                                            $product = \App\Models\Product::find($id);
                                            $imageUrl = null;
                                            if($product && is_array($product->images) && count($product->images) > 0) {
                                                $imageUrl = asset('images/products/' . $product->images[0]);
                                            } elseif(file_exists(public_path('images/products/' . $id . '.jpg'))) {
                                                $imageUrl = asset('images/products/' . $id . '.jpg');
                                            }
                                        @endphp
                                        <div class="w-16 h-16 bg-earth-200 rounded-lg overflow-hidden shrink-0 flex items-center justify-center">
                                            @if($imageUrl)
                                                <img src="{{ $imageUrl }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-8 h-8 text-earth-500 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                            @endif
                                        </div>
                                        <span class="font-bold text-earth-900">{{ $details['name'] }}</span>
                                    </td>
                                    <td class="py-6">{{ $details['currency'] }} {{ number_format($details['price'], 2) }}</td>
                                    <td class="py-6">{{ $details['quantity'] }}</td>
                                    <td class="py-6 text-right font-semibold">{{ $details['currency'] }} {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    <td class="py-6 text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2 font-medium">{{ __('Hapus') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 bg-white rounded-3xl p-6 sm:p-10 border border-earth-200 shadow-xl">
                <a href="{{ route('gallery.index') }}" class="text-earth-500 hover:text-earth-800 font-medium transition">&larr; {{ __('Lanjut Belanja') }}</a>
                <div class="flex flex-col items-end gap-4 w-full sm:w-auto">
                    <div class="text-2xl text-earth-700">{{ __('Total') }}: <span class="font-bold text-earth-900 ml-2">IDR {{ number_format($total, 2) }}</span></div>
                    <a href="{{ route('checkout.index') }}" class="w-full sm:w-auto px-8 py-4 bg-earth-800 text-earth-100 rounded-lg text-lg font-medium hover:bg-earth-900 transition-colors shadow-md text-center">
                        {{ __('Lanjut ke Pembayaran') }}
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 border border-earth-200 shadow-xl text-center">
                <svg class="w-24 h-24 text-earth-200 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <h2 class="text-2xl font-bold text-earth-900 mb-4">{{ __('Keranjang belanja Anda kosong') }}</h2>
                <a href="{{ route('gallery.index') }}" class="inline-block px-8 py-4 bg-earth-800 text-earth-100 rounded-lg font-medium hover:bg-earth-900 transition">{{ __('Mulai Belanja') }}</a>
            </div>
        @endif
    </div>
</x-layout>
