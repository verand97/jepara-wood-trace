<x-layout>
    <x-slot:title>Pesanan Berhasil | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="bg-white rounded-3xl p-10 border border-earth-200 shadow-xl text-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h1 class="text-4xl font-bold text-earth-900 mb-4">{{ __('Pesanan Berhasil Diterima!') }}</h1>
            <p class="text-lg text-earth-700 mb-8 max-w-2xl mx-auto">Terima kasih telah berbelanja benda seni otentik dari Jepara Wood-Trace. Kami sedang memproses persiapan pengiriman dan verifikasi penerbitan sertifikat SVLK baru Anda.</p>
            
            <div class="bg-earth-50 rounded-2xl p-6 text-left max-w-xl mx-auto mb-10 border border-earth-100">
                <h2 class="font-bold text-earth-900 mb-4 border-b border-earth-200 pb-2">Rincian Referensi Order:</h2>
                <ul class="space-y-2 text-earth-800">
                    <li><span class="font-medium text-earth-600">ID Pesanan:</span> #JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</li>
                    <li><span class="font-medium text-earth-600">Total Tagihan:</span> {{ $order->currency }} {{ number_format($order->total_amount, 2) }}</li>
                    <li><span class="font-medium text-earth-600">Gateway Pemrosesan:</span> {{ strtoupper($order->payment_gateway) }}</li>
                    <li><span class="font-medium text-earth-600">Status Gateway:</span> <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold uppercase">{{ $order->status }}</span></li>
                </ul>
            </div>

            <a href="{{ route('gallery.index') }}" class="inline-block px-8 py-4 bg-earth-800 text-earth-100 rounded-lg text-lg font-medium hover:bg-earth-900 transition-colors shadow-md">
                {{ __('Kembali ke Galeri') }}
            </a>
        </div>
    </div>
</x-layout>
