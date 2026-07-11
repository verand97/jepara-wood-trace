<x-layout>
    <x-slot:title>Pesanan Berhasil | Jepara Wood-Trace</x-slot:title>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl p-10 sm:p-14 border border-earth-200 shadow-2xl text-center w-full max-w-3xl mx-auto my-8">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            
            <h1 class="text-4xl font-bold text-earth-900 mb-6">{{ __('Pesanan Berhasil Diterima!') }}</h1>
            <p class="text-lg text-earth-700 mb-10 max-w-2xl mx-auto leading-relaxed">Terima kasih telah berbelanja benda seni otentik dari Jepara Wood-Trace. Kami sedang memproses persiapan pengiriman dan verifikasi penerbitan sertifikat SVLK baru Anda.</p>
            
            <div class="bg-earth-50 rounded-2xl p-6 sm:p-8 text-left max-w-xl mx-auto mb-12 border border-earth-100 shadow-inner">
                <h2 class="font-bold text-earth-900 mb-4 border-b border-earth-200 pb-3 text-lg">Rincian Referensi Order:</h2>
                <ul class="space-y-3 text-earth-800">
                    <li class="flex justify-between"><span class="font-medium text-earth-500">ID Pesanan:</span> <span class="font-bold">#JWT-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></li>
                    <li class="flex justify-between"><span class="font-medium text-earth-500">Total Tagihan:</span> <span class="font-bold">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span></li>
                    <li class="flex justify-between"><span class="font-medium text-earth-500">Gateway:</span> <span class="font-bold">{{ strtoupper($order->payment_gateway) }}</span></li>
                    <li class="flex justify-between items-center"><span class="font-medium text-earth-500">Status:</span> <span class="bg-green-100 text-green-800 px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wide">{{ $order->status }}</span></li>
                </ul>
            </div>

            <a href="{{ route('gallery.index') }}" class="inline-block px-10 py-4 bg-earth-900 text-earth-100 rounded-xl text-lg font-bold hover:bg-black transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-1 mb-2">
                {{ __('Kembali ke Galeri') }}
            </a>
        </div>
    </div>
</x-layout>
