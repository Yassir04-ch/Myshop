<x-guest-layout>
    <div class="w-full bg-white rounded-[2rem] shadow-2xl flex flex-col md:flex-row overflow-hidden border border-slate-100/80 transition-all duration-300">
        
        <!-- SIDEBAR (Left Side) -->
        <div class="md:w-1/3 bg-slate-950 p-10 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-600/10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Welcome to MyShop</span>
                <h2 class="text-3xl font-black mt-3 mb-6 leading-tight">Join Us!</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Create an account to track orders, save favorites, and get exclusive early access to our premium deals.</p>
            </div>
            
            <div class="space-y-4 mt-8 md:mt-0 relative z-10">
                <div class="flex items-center gap-3 group">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-300">Fast & Safe Checkout</span>
                </div>
                
                <div class="flex items-center gap-3 group">
                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <span class="text-sm font-medium text-slate-300">Real-time Order Tracking</span>
                </div>
            </div>
        </div>

        <!-- FORM SIDE (Right Side) -->
        <div class="md:w-2/3 p-8 sm:p-12 md:p-14 bg-white">
            <h1 class="text-2xl font-extrabold text-slate-900 mb-8 tracking-tight">Register Your Account</h1>
            
            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">
                @csrf

                <!-- First Name -->
                <div class="space-y-1.5">
                    <x-input-label for="firstname" :value="__('First Name')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="firstname" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                    <x-input-error :messages="$errors->get('firstname')" class="mt-1 text-xs" />
                </div>

                <!-- Last Name -->
                <div class="space-y-1.5">
                    <x-input-label for="lastname" :value="__('Last Name')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="lastname" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="text" name="lastname" :value="old('lastname')" required autocomplete="lastname" />
                    <x-input-error :messages="$errors->get('lastname')" class="mt-1 text-xs" />
                </div>

                <!-- Email Address  -->
                <div class="sm:col-span-2 space-y-1.5">
                    <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="email" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <!-- Phone -->
                <div class="sm:col-span-2 space-y-1.5">
                    <x-input-label for="phone" :value="__('Phone Number')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="phone" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="password" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-bold text-slate-500 uppercase tracking-wider" />
                    <x-text-input id="password_confirmation" class="w-full px-4 py-3 bg-slate-50/60 border border-slate-200 rounded-xl outline-none focus:border-indigo-500 focus:ring-indigo-500/20 text-sm transition-all" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                </div>

                <!-- CTA -->
                <div class="sm:col-span-2 pt-4 space-y-5">
                    <x-primary-button class="w-full justify-center bg-slate-950 text-white font-bold py-4 rounded-xl hover:bg-indigo-600 shadow-lg shadow-indigo-600/10 hover:shadow-indigo-600/20 transform hover:-translate-y-0.5 transition-all duration-300">
                        {{ __('Create Account') }}
                    </x-primary-button>
                    
                    <p class="text-center text-slate-500 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4 decoration-indigo-300">
                            Login
                        </a>
                    </p>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>