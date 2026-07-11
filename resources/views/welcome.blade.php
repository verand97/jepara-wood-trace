<x-layout>
    <div class="flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-20 relative">
        <div class="max-w-4xl text-center relative z-10">
            <div class="inline-block px-4 py-1.5 rounded-full border border-earth-500 text-earth-500 text-xs font-semibold tracking-wider uppercase mb-8">
                {{ __('messages.hero_badge') }}
            </div>
            <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-6 text-earth-900">
                {!! __('messages.hero_title') !!}
            </h1>
            <p class="text-lg md:text-xl text-earth-700 mb-10 max-w-2xl mx-auto leading-relaxed">
                {{ __('messages.hero_description') }}
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('gallery.index') }}" class="px-8 py-4 bg-earth-800 text-earth-100 rounded text-lg font-medium hover:bg-earth-900 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    {{ __('messages.explore_gallery') }}
                </a>
                <a href="#" class="px-8 py-4 bg-white/50 backdrop-blur border border-earth-500 text-earth-800 rounded text-lg font-medium hover:bg-earth-200 transition duration-300">
                    {{ __('messages.verify_svlk') }}
                </a>
            </div>
        </div>

        <div class="mt-20 w-full max-w-5xl rounded-2xl overflow-hidden shadow-2xl relative group bg-white border border-earth-200 p-2 sm:p-4 z-10">
             <div class="w-full h-[300px] sm:h-[500px] bg-[#fdfdfc] rounded-xl flex items-center justify-center border-2 border-dashed border-earth-200">
                 <div class="text-center">
                     <svg class="mx-auto h-16 w-16 text-earth-500 mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                     </svg>
                     <p class="text-earth-700 font-medium text-lg">{{ __('messages.model_viewer_placeholder') }}</p>
                     <p class="text-sm text-earth-500 mt-2 max-w-xs mx-auto">{{ __('messages.interactive_preview') }}</p>
                 </div>
             </div>
        </div>
    </div>
</x-layout>
