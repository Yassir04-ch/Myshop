<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-4xl w-full bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row overflow-hidden border border-slate-100 mx-auto">
        
        <div class="md:w-1/3 bg-slate-950 p-10 text-white flex flex-col justify-between relative overflow-hidden shrink-0">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Welcome Back to MyShop</span>
                <h2 class="text-3xl font-black mt-3 mb-6 leading-tight">Join Us Again!</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Log in to track your current orders, view your saved favorites, and access exclusive new tech deals.</p>
            </div>
            
            <div class="space-y-4 mt-8 md:mt-0 relative z-10">
                <div class="flex items-center gap-3 group">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-300">Real-time Order Updates</span>
                </div>
                
                <div class="flex items-center gap-3 group">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-300">Secure Account Access</span>
                </div>
            </div>
        </div>

        <div class="md:w-2/3 p-8 sm:p-12 md:p-16 bg-white flex flex-col justify-center">
            <h1 class="text-2xl font-extrabold text-slate-900 mb-8 tracking-tight">Log in to Your Account</h1>
            
            {{-- Hna khdemna b flex flex-col o space-y bache ga3 l-inputs ymshiw wahed t7t wahed --}}
            <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-5 w-full">
                @csrf

                <div class="space-y-1.5 w-full">
                    <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="email" class="w-full block px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div class="space-y-1.5 w-full">
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="password" class="w-full block px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4" name="remember">
                        <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-slate-600 hover:text-indigo-600 transition-colors underline decoration-slate-200 hover:decoration-indigo-500 underline-offset-4" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="pt-4 space-y-5">
                    <x-primary-button class="w-full justify-center bg-slate-950 text-white font-bold py-4 rounded-xl hover:bg-indigo-600 shadow-lg shadow-indigo-600/10 hover:shadow-indigo-600/20 transform hover:-translate-y-0.5 transition-all duration-300">
                        {{ __('Log in') }}
                    </x-primary-button>
                    
                    <p class="text-center text-slate-500 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4 decoration-indigo-300">
                            Register
                        </a>
                    </p>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>