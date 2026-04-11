<x-guest-layout>
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Selamat Datang</h2>
        <p class="text-gray-500 text-sm mt-2">Silakan masuk ke akun Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex justify-between items-center mb-2 ml-1">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Password</label>
                    @if (Route::has('password.request'))
                        <a class="text-xs font-semibold text-blue-600 hover:text-blue-700" href="{{ route('password.request') }}">Lupa?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 rounded-xl transition-all duration-200 outline-none text-gray-700">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-500 cursor-pointer group">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-200 text-blue-600 focus:ring-blue-500/20 transition-all">
                <span class="ml-2 group-hover:text-gray-700">Ingat Sesi Saya</span>
            </label>
        </div>

        <button class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-[0_10px_20px_rgba(37,99,235,0.2)] hover:shadow-[0_10px_25px_rgba(37,99,235,0.3)] transition-all duration-300">
            Masuk Sekarang
        </button>

        <div class="mt-10 text-center">
            <p class="text-sm text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:text-blue-700 transition-colors">Daftar Gratis</a>
            </p>
        </div>
    </form>
</x-guest-layout>