@extends('layouts.navigation')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-[#f8fafc] py-12 relative overflow-x-hidden">
    
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-600/5 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-purple-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 space-y-6 relative z-10">

        @if (session('success') || session('status') === 'password-updated')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3.5 rounded-2xl text-xs font-semibold flex items-center gap-2.5 shadow-sm animate-[slideDown_0.2s_ease-out]">
                <i class="fas fa-check-circle text-sm text-emerald-500"></i>
                <span>
                    {{ session('success') ? 'Profil mis à jour avec succès.' : 'Mot de passe modifié avec succès.' }}
                </span>
            </div>
        @endif

        <div class="bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 rounded-3xl p-6 sm:p-8 text-white shadow-lg shadow-indigo-600/10 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-48 h-48 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="flex flex-col sm:flex-row items-center gap-5 relative z-10 text-center sm:text-left">
                <div class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-2xl font-black tracking-wider text-white shadow-inner shrink-0">
                    {{ strtoupper(substr(auth()->user()->firstname, 0, 1) . substr(auth()->user()->lastname, 0, 1)) }}
                </div>

                <div class="space-y-1">
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight leading-none">
                        {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                    </h1>
                    <p class="text-sm text-indigo-100/80 font-medium">
                        <i class="far fa-envelope mr-1 text-xs"></i> {{ auth()->user()->email }}
                    </p>
                    <div class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-md px-3 py-1 rounded-xl text-xs font-bold border border-white/10 mt-1 shadow-sm">
                        <i class="fas fa-crown text-amber-300 text-[11px]"></i>
                        <span>{{ auth()->user()->points ?? 0 }} Points fidélité</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs border border-indigo-100/60 shadow-sm">
                    <i class="fas fa-id-card"></i>
                </div>
                <h2 class="font-black text-base text-slate-800 tracking-tight">Informations personnelles</h2>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="p-6 space-y-5">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Prénom
                        </label>
                        <input
                            type="text"
                            name="firstname"
                            value="{{ old('firstname', auth()->user()->firstname) }}"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all @error('firstname') border-rose-400 bg-rose-50/20 @enderror">
                        @error('firstname')
                            <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Nom
                        </label>
                        <input
                            type="text"
                            name="lastname"
                            value="{{ old('lastname', auth()->user()->lastname) }}"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all @error('lastname') border-rose-400 bg-rose-50/20 @enderror">
                        @error('lastname')
                            <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Adresse Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all @error('email') border-rose-400 bg-rose-50/20 @enderror">
                        @error('email')
                            <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Téléphone
                        </label>
                        <input
                            type="text"
                            name="telephone"
                            value="{{ old('telephone', auth()->user()->phone) }}"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-indigo-600/10 focus:border-indigo-600 outline-none transition-all @error('telephone') border-rose-400 bg-rose-50/20 @enderror">
                        @error('telephone')
                            <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-indigo-600/10 transition-all active:scale-95">
                        <i class="fas fa-floppy-disk text-[11px]"></i>
                        <span>Enregistrer les modifications</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-xs border border-rose-100/60 shadow-sm">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h2 class="font-black text-base text-slate-800 tracking-tight">Sécurité du compte</h2>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                        Mot de passe actuel
                    </label>
                    <input
                        type="password"
                        name="current_password"
                        class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-rose-600/10 focus:border-rose-500 outline-none transition-all @error('current_password', 'updatePassword') border-rose-400 bg-rose-50/20 @enderror">
                    @error('current_password', 'updatePassword')
                        <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Nouveau mot de passe
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-rose-600/10 focus:border-rose-500 outline-none transition-all @error('password', 'updatePassword') border-rose-400 bg-rose-50/20 @enderror">
                        @error('password', 'updatePassword')
                            <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            Confirmation du mot de passe
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full text-xs font-medium border border-slate-200 bg-slate-50/30 rounded-xl p-3 focus:bg-white focus:ring-4 focus:ring-rose-600/10 focus:border-rose-500 outline-none transition-all">
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-rose-600/10 transition-all active:scale-95">
                        <i class="fas fa-key text-[11px]"></i>
                        <span>Modifier le mot de passe</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<style scoped>
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-6px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
