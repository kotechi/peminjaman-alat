<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <!-- Header dengan styling yang lebih menarik -->
        <div class="text-center mb-2">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                {{ __('Selamat Datang Kembali') }} 👋
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Masuk ke akun Anda untuk melanjutkan') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address dengan styling lebih baik -->
            <div>
                <flux:input
                    name="email"
                    :label="__('Alamat Email')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="nama@example.com"
                    class="w-full"
                />
            </div>

            <!-- Password dengan styling lebih baik -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Kata Sandi')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Masukkan kata sandi')"
                    viewable
                    class="w-full"
                />

                {{-- Uncomment jika fitur lupa password diperlukan --}}
                {{-- @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-xs end-0 text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300" :href="route('password.request')" wire:navigate>
                        {{ __('Lupa kata sandi?') }}
                    </flux:link>
                @endif --}}
            </div>

            <!-- Remember Me dengan styling lebih baik -->
            <div class="flex items-center">
                <flux:checkbox 
                    name="remember" 
                    :label="__('Ingat saya')" 
                    :checked="old('remember')"
                    class="text-purple-600 focus:ring-purple-500"
                />
            </div>

            <!-- Login Button dengan gradient -->
            <div class="flex items-center justify-end pt-2">
                <button 
                    type="submit" 
                    class="w-full px-6 py-3.5 text-white font-bold rounded-xl text-sm shadow-2xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1 gradient-bg"
                    data-test="login-button"
                >
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        {{ __('Masuk') }}
                    </span>
                </button>
            </div>
        </form>
        
        {{-- Uncomment jika fitur register diperlukan --}}
        {{-- @if (Route::has('register'))
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="text-center text-sm">
                    <span class="text-gray-600 dark:text-gray-400">{{ __('Belum punya akun?') }}</span>
                    <flux:link 
                        :href="route('register')" 
                        wire:navigate
                        class="ml-1 font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors"
                    >
                        {{ __('Daftar sekarang') }}
                    </flux:link>
                </div>
            </div>
        @endif --}}
        
        <!-- Info tambahan -->
        <div class="mt-4 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                Dengan masuk, Anda menyetujui syarat dan ketentuan kami
            </p>
        </div>
    </div>
</x-layouts::auth>