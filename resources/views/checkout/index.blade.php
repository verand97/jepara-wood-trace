<x-layout>
    <x-slot:title>{{ __('Pembayaran') }} | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-earth-900 mb-8">{{ __('Selesaikan Pesanan Anda') }}</h1>

        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf
            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Form Pengiriman -->
                <div class="flex-1 bg-white rounded-3xl p-6 sm:p-10 border border-earth-200 shadow-xl">
                    <h2 class="text-2xl font-bold text-earth-900 mb-6 border-b border-earth-100 pb-4">{{ __('Alamat Pengiriman') }}</h2>
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Nama Depan') }}</label>
                                <input type="text" name="first_name" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Nama Belakang') }}</label>
                                <input type="text" name="last_name" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Alamat Lengkap') }}</label>
                            <input type="text" name="address" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500" required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Kota') }}</label>
                                <input type="text" name="city" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Kode Pos') }}</label>
                                <input type="text" name="postal_code" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-earth-700 mb-2">{{ __('Negara') }}</label>
                            <select name="country" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500">
                                <option value="ID">Indonesia</option>
                                <option value="US">United States</option>
                                <option value="UK">United Kingdom</option>
                                <option value="EU">Europe (Other)</option>
                            </select>
                        </div>

                        <div class="pt-6 mt-6 border-t border-earth-100">
                            <h2 class="text-2xl font-bold text-earth-900 mb-6">{{ __('Metode Pemrosesan') }}</h2>
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border border-earth-200 rounded-lg cursor-pointer hover:bg-earth-100 transition">
                                    <input type="radio" name="payment_method" value="midtrans" class="w-5 h-5 text-earth-800 border-earth-200 focus:ring-earth-500" checked>
                                    <span class="ml-3 font-medium text-earth-900">Pembayaran Bank / E-Wallet (Midtrans)</span>
                                </label>
                                <label class="flex items-center p-4 border border-earth-200 rounded-lg cursor-pointer hover:bg-earth-100 transition">
                                    <input type="radio" name="payment_method" value="stripe" class="w-5 h-5 text-earth-800 border-earth-200 focus:ring-earth-500">
                                    <span class="ml-3 font-medium text-earth-900">Kartu Kredit Internasional (Stripe)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pesanan -->
                <div class="w-full lg:w-96 shrink-0">
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-earth-200 shadow-xl sticky top-28">
                        <h3 class="text-xl font-bold text-earth-900 mb-6 border-b border-earth-100 pb-4">{{ __('Ringkasan Pesanan') }}</h3>
                        
                        <div class="space-y-4 mb-6">
                            @foreach($cart as $details)
                            <div class="flex justify-between text-sm">
                                <span class="text-earth-700">{{ $details['quantity'] }}x {{ $details['name'] }}</span>
                                <span class="font-medium text-earth-900">IDR {{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-earth-200 pt-4 mb-8">
                            <div class="flex justify-between items-center text-lg">
                                <span class="text-earth-700">{{ __('Total') }}</span>
                                <span class="font-bold text-earth-900">IDR {{ number_format($total, 2) }}</span>
                            </div>
                            <p class="text-xs text-earth-500 mt-2">{{ __('Pajak dan biaya pengiriman internasional akan dihitung pada langkah selanjutnya.') }}</p>
                        </div>

                        <button type="submit" class="w-full px-6 py-4 bg-earth-800 text-earth-100 rounded-lg text-lg font-medium hover:bg-earth-900 transition-colors shadow-md text-center">
                            {{ __('Proses Checkout') }}
                        </button>
                        
                        <div class="mt-8 pt-6 border-t border-earth-100">
                            <div class="flex justify-center gap-6 opacity-75">
                                <div class="h-6 w-10 bg-earth-300 rounded flex items-center justify-center text-white text-[10px] font-bold">VISA</div>
                                <div class="h-6 w-10 bg-earth-300 rounded flex items-center justify-center text-white text-[10px] font-bold">MC</div>
                                <div class="h-6 w-10 bg-earth-300 rounded flex items-center justify-center text-white text-[10px] font-bold">QRIS</div>
                            </div>
                            <p class="text-center text-xs text-earth-500 mt-3 font-medium tracking-wide">{{ __('TRANSAKSI AMAN & TERENKRIPSI') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
