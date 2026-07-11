<x-layout>
    <x-slot:title>Masuk | Jepara Wood-Trace</x-slot:title>

    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-12">
        <div class="bg-white rounded-3xl p-8 sm:p-12 border border-earth-200 shadow-2xl w-full max-w-md">
            <h1 class="text-3xl font-bold text-earth-900 mb-2 text-center">Selamat Datang Kembali</h1>
            <p class="text-earth-500 text-center mb-8">Masuk ke akun Anda untuk melanjutkan.</p>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-earth-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-earth-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-earth-200 focus:outline-none focus:ring-2 focus:ring-earth-500 bg-earth-50" required>
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-earth-300 text-earth-800 focus:ring-earth-500">
                        <span class="ml-2 text-sm text-earth-600">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-sm text-earth-600 hover:text-earth-900 font-medium transition">Lupa Password?</a>
                </div>
                
                <button type="submit" class="w-full px-6 py-4 bg-earth-900 text-earth-100 rounded-xl text-lg font-bold hover:bg-black transition-colors shadow-lg mt-4 transform hover:-translate-y-1">
                    Masuk
                </button>
            </form>
            
            <p class="mt-8 text-center text-earth-600">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-earth-900 hover:underline transition">Daftar sekarang</a>
            </p>
        </div>
    </div>
</x-layout>
