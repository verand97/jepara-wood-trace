<x-layout>
    <x-slot:title>Daftar | Jepara Wood-Trace</x-slot:title>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-12">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-earth-200 shadow-2xl w-full max-w-lg">
            <h1 class="text-3xl font-bold text-earth-900 mb-2 text-center">Buat Akun Baru</h1>
            <p class="text-earth-500 text-center mb-8">Bergabunglah untuk mulai mengkoleksi mahakarya Jepara.</p>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-earth-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg border {{ $errors->has('name') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-earth-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border {{ $errors->has('email') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-earth-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border {{ $errors->has('password') ? 'border-red-500' : 'border-earth-200' }} focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-earth-700 mb-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                    </div>
                </div>
                
                <button type="submit" class="w-full px-6 py-4 bg-earth-900 text-earth-100 rounded-xl text-lg font-bold hover:bg-black transition-colors shadow-lg mt-6 transform hover:-translate-y-1">
                    Daftar
                </button>
            </form>
            
            <p class="mt-8 text-center text-earth-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-earth-900 hover:underline transition">Masuk di sini</a>
            </p>
        </div>
    </div>
</x-layout>
