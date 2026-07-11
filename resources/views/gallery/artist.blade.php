<x-layout>
    <x-slot:title>{{ $artist->name }} | Jepara Wood-Trace</x-slot:title>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-earth-200 shadow-xl mb-12 flex flex-col md:flex-row gap-10 items-center md:items-start">
            <div class="w-48 h-48 sm:w-64 sm:h-64 rounded-full overflow-hidden bg-earth-200 shrink-0 border-4 border-white shadow-lg relative">
                @if($artist->profile_photo_path)
                    <img src="{{ asset($artist->profile_photo_path) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                @else
                    <div class="absolute inset-0 flex items-center justify-center text-earth-500">
                        <svg class="w-20 h-20 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                @endif
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-4xl sm:text-5xl font-bold text-earth-900 mb-4">{{ $artist->name }}</h1>
                <div class="inline-block px-3 py-1 bg-earth-100 text-earth-800 text-xs font-semibold rounded uppercase tracking-wider mb-6">
                    Master Artisan of Jepara
                </div>
                <div class="prose prose-earth text-earth-700 leading-relaxed max-w-none">
                    {!! nl2br(e($artist->bio ?? 'A dedicated master carver from Desa Senenan, passing down generations of traditional woodworking techniques.')) !!}
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-3xl font-bold text-earth-900 border-b border-earth-200 pb-4">Portfolio & Works</h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($artist->products as $product)
                <div class="group bg-white rounded-2xl border border-earth-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('gallery.product', $product->id) }}" class="block aspect-4/3 bg-earth-200 relative overflow-hidden">
                        @if(is_array($product->images) && count($product->images) > 0)
                            <img src="{{ asset('images/products/' . $product->images[0]) }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @elseif(file_exists(public_path('images/products/' . $product->id . '.jpg')))
                            <img src="{{ asset('images/products/' . $product->id . '.jpg') }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-earth-500">No Cover Image</div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-earth-900 line-clamp-1">{{ $product->title }}</h3>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-earth-800 font-semibold">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('gallery.product', $product->id) }}" class="text-sm font-medium text-earth-500 hover:text-earth-900 transition">View Details &rarr;</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-earth-500 bg-white/50 rounded-2xl border-2 border-dashed border-earth-200">
                    <p class="text-lg">No works listed yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
