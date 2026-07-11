<x-layout>
    <x-slot:title>Gallery | Jepara Wood-Trace</x-slot:title>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-earth-900 mb-4">{{ __('messages.gallery') }}</h1>
            <p class="text-earth-700 max-w-2xl mx-auto">Discover authentic 3D relief carvings, sourced legally and sculpted traditionally by master artisans of Jepara.</p>
        </div>

        <!-- Filters -->
        <div class="flex justify-center space-x-4 mb-12">
            <a href="{{ route('gallery.index') }}" class="px-4 py-2 rounded-full border {{ !request('method') ? 'bg-earth-800 text-white border-transparent' : 'border-earth-500 text-earth-700 hover:bg-earth-200' }} transition">All</a>
            <a href="{{ route('gallery.index', ['method' => 'Hand-Carved']) }}" class="px-4 py-2 rounded-full border {{ request('method') == 'Hand-Carved' ? 'bg-earth-800 text-white border-transparent' : 'border-earth-500 text-earth-700 hover:bg-earth-200' }} transition">Hand-Carved</a>
            <a href="{{ route('gallery.index', ['method' => 'CNC-Assisted']) }}" class="px-4 py-2 rounded-full border {{ request('method') == 'CNC-Assisted' ? 'bg-earth-800 text-white border-transparent' : 'border-earth-500 text-earth-700 hover:bg-earth-200' }} transition">CNC-Assisted</a>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="group bg-white rounded-2xl border border-earth-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <a href="{{ route('gallery.product', $product->id) }}" class="block aspect-4/3 bg-earth-200 relative overflow-hidden">
                        @if(is_array($product->images) && count($product->images) > 0)
                            <img src="{{ asset('images/products/' . $product->images[0]) }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @elseif(file_exists(public_path('images/products/' . $product->id . '.jpg')))
                            <img src="{{ asset('images/products/' . $product->id . '.jpg') }}" alt="{{ $product->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <!-- Placeholder for image -->
                            <div class="absolute inset-0 flex items-center justify-center text-earth-500">
                                No Cover Image
                            </div>
                        @endif
                    </a>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-earth-900 line-clamp-1">{{ $product->title }}</h3>
                            <span class="text-earth-800 font-semibold">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                        </div>
                        <p class="text-earth-500 text-sm mb-4">By <a href="{{ route('gallery.artist', $product->artist_id) }}" class="hover:text-earth-800 underline decoration-earth-200">{{ $product->artist->name }}</a></p>
                        
                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-earth-100">
                            <span class="text-xs px-2 py-1 bg-earth-100 rounded text-earth-700">{{ $product->production_method }}</span>
                            @if($product->svlk_certificate_number)
                                <span class="text-xs flex items-center text-green-700 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    SVLK Verified
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-earth-500 bg-white/50 rounded-2xl border-2 border-dashed border-earth-200">
                    <p class="text-lg">No authentic reliefs found matching your criteria.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
