<x-layout>
    <x-slot:title>Cek SVLK | Jepara Wood-Trace</x-slot:title>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-earth-900 mb-4">{{ __('Verifikasi Legalitas Kayu (SVLK)') }}</h1>
            <p class="text-earth-700">{{ __('Pastikan keaslian dan legalitas karya seni ukir Jepara Anda dengan melacak nomor sertifikat SVLK yang terdaftar di basis data kami.') }}</p>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-earth-200 shadow-xl mb-12">
            <form action="{{ route('pages.svlk') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Contoh:') }} SVLK-JPR-2023-0941" class="flex-1 px-6 py-4 rounded-xl border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 text-lg font-mono tracking-wider" required>
                <button type="submit" class="px-8 py-4 bg-earth-800 text-earth-100 rounded-xl font-medium hover:bg-earth-900 transition shadow-md whitespace-nowrap flex gap-2 justify-center items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    {{ __('Cek Sertifikat') }}
                </button>
            </form>
        </div>

        @if($query)
            @if($product)
                <div class="bg-[#f0f9f4] border border-[#c3e6cb] rounded-2xl p-8 flex flex-col md:flex-row gap-8 items-start shadow-sm">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <h2 class="text-2xl font-bold text-green-900">{{ __('Sertifikat Valid & Resmi') }}</h2>
                        </div>
                        <ul class="space-y-3 text-green-900 text-lg">
                            <li><strong class="text-green-800 tracking-wider font-mono">Nomor SVLK:</strong> {{ $product->svlk_certificate_number }}</li>
                            <li><strong class="text-green-800">Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($product->svlk_issue_date)->format('d M Y') }}</li>
                            <li><strong class="text-green-800">Karya Pautan:</strong> <a href="{{ route('gallery.product', $product->id) }}" class="underline font-bold hover:text-green-700">{{ $product->title }}</a></li>
                            <li><strong class="text-green-800">Pengukir:</strong> <a href="{{ route('gallery.artist', $product->artist_id) }}" class="underline hover:text-green-700">{{ $product->artist->name }}</a></li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="bg-[#fcf0f0] border border-[#e6c3c3] rounded-2xl p-10 text-center shadow-sm">
                    <svg class="w-16 h-16 text-red-500 mx-auto mb-6 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h2 class="text-3xl font-bold text-red-900 mb-4">{{ __('Sertifikat Tidak Ditemukan') }}</h2>
                    <p class="text-red-800 text-lg leading-relaxed max-w-2xl mx-auto">Sistem kami menyatakan nomor sertifikat <span class="font-bold underline">"{{ $query }}"</span> tidak valid atau tidak terdaftar dalam basis data legalitas karya Jepara Wood-Trace.</p>
                </div>
            @endif
        @endif
    </div>
</x-layout>
