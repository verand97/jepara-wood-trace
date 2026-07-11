<x-layout>
    <x-slot:title>Artisans | Jepara Wood-Trace</x-slot:title>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-earth-900 mb-8 border-b border-earth-200 pb-4">{{ __('Kolektif Seniman Jepara') }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($artists as $artist)
                <div class="bg-white rounded-2xl border border-earth-200 p-6 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-32 h-32 rounded-full overflow-hidden bg-earth-200 mb-4 border-4 border-earth-100 flex items-center justify-center text-earth-500">
                        @if($artist->profile_photo_path)
                            <img src="{{ asset($artist->profile_photo_path) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-earth-900 mb-2">{{ $artist->name }}</h3>
                    <p class="text-sm text-earth-700 mb-6 line-clamp-3">{{ $artist->bio }}</p>
                    <a href="{{ route('gallery.artist', $artist->id) }}" class="mt-auto px-6 py-2 bg-earth-800 text-earth-100 rounded-full font-medium hover:bg-earth-900 transition">{{ __('Lihat Profil & Karya') }}</a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
