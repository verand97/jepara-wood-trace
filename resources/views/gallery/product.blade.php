<x-layout>
    <x-slot:title>{{ $product->title }} | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('gallery.index') }}" class="text-earth-500 hover:text-earth-800 flex items-center text-sm font-medium transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Gallery
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 bg-white p-6 sm:p-10 rounded-3xl border border-earth-200 shadow-xl">
            <!-- Left: Model Viewer AR -->
            <div class="bg-earth-100 rounded-2xl overflow-hidden aspect-square border border-earth-200 relative">
                @php
                    $imageUrl = null;
                    if(is_array($product->images) && count($product->images) > 0) {
                        $imageUrl = asset('images/products/' . $product->images[0]);
                    } elseif(file_exists(public_path('images/products/' . $product->id . '.jpg'))) {
                        $imageUrl = asset('images/products/' . $product->id . '.jpg');
                    }
                @endphp

                @if($imageUrl)
                    <img src="{{ $imageUrl }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-earth-500">
                        <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <p class="font-medium">Image Not Available</p>
                    </div>
                @endif
            </div>

            <!-- Right: Details -->
            <div class="flex flex-col">
                <div class="mb-2">
                    <span class="inline-block px-3 py-1 bg-earth-100 text-earth-800 text-xs font-semibold rounded uppercase tracking-wider mb-4">{{ $product->production_method }}</span>
                </div>
                <h1 class="text-4xl font-bold text-earth-900 mb-2">{{ $product->title }}</h1>
                <p class="text-lg text-earth-500 mb-6">Masterpiece by <a href="{{ route('gallery.artist', $product->artist_id) }}" class="text-earth-800 underline decoration-earth-200 hover:text-earth-900">{{ $product->artist->name }}</a></p>

                <div class="text-3xl font-semibold text-earth-900 mb-8 border-b border-earth-100 pb-8">
                    {{ $product->currency }} {{ number_format($product->price, 2) }}
                </div>

                <div class="prose prose-earth mb-8 text-earth-700 leading-relaxed">
                    <p>{{ $product->description ?? 'Experience the depth and intricacy of this authentic hand-carved relief, brought to you directly from the master artisans of Jepara. Each piece reflects centuries of tradition and passion.' }}</p>
                </div>

                <!-- SVLK Box -->
                <div class="bg-[#f0f9f4] border border-[#c3e6cb] rounded-lg p-5 mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <h4 class="font-semibold text-green-900 font-sans text-lg">SVLK Certified Origin</h4>
                    </div>
                    <p class="text-green-800 text-sm">
                        This artwork complies with the standard for System Verifikasi Legalitas Kayu (Wood Legality Verification System).<br/>
                        <strong>Certificate:</strong> {{ $product->svlk_certificate_number ?? 'Pending Registration' }}
                    </p>
                </div>

                <div class="mt-auto pt-4">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4 mb-4">
                            <label class="text-sm font-medium text-earth-700">{{ __('Jumlah') }}:</label>
                            <div class="flex items-center border border-earth-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <button type="button" onclick="adjustQty(-1)" class="px-4 py-3 text-earth-700 hover:bg-earth-100 transition font-bold text-lg leading-none">−</button>
                                <input type="number" name="quantity" id="qty-input" value="1" min="1" max="{{ $product->stock ?? 10 }}" class="w-16 text-center border-x border-earth-200 py-3 text-earth-900 font-semibold focus:outline-none focus:ring-0" readonly>
                                <button type="button" onclick="adjustQty(1)" class="px-4 py-3 text-earth-700 hover:bg-earth-100 transition font-bold text-lg leading-none">+</button>
                            </div>
                            <span class="text-sm text-earth-500">
                                @if(($product->stock ?? 0) > 0) Stok: {{ $product->stock }} @endif
                            </span>
                        </div>
                        <button type="submit" class="w-full bg-earth-800 text-earth-100 py-4 rounded-lg text-lg font-medium hover:bg-earth-900 transition-colors shadow-md flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            {{ __('Tambahkan ke Keranjang') }}
                        </button>
                    </form>
                </div>

                <script>
                function adjustQty(delta) {
                    const input = document.getElementById('qty-input');
                    const max = parseInt(input.max) || 99;
                    let val = parseInt(input.value) + delta;
                    if (val < 1) val = 1;
                    if (val > max) val = max;
                    input.value = val;
                }
                </script>
            </div>
        </div>
    </div>
</x-layout>
