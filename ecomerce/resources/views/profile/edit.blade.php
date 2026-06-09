@extends('layouts.navigation')

@section('content')
<style>
    .glass-card-profile {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(15, 23, 42, 0.05);
    }
    .smooth-transition {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
</style>

<div class="py-6 sm:py-12">
    <div class="max-w-5xl mx-auto px-4 space-y-8">

        <div class="relative overflow-hidden rounded-[2.5rem] p-8 bg-gradient-to-br from-slate-900 via-slate-950 to-indigo-950 border border-slate-800 shadow-xl shadow-indigo-950/10">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-500 to-indigo-700 flex items-center justify-center font-black text-white text-2xl tracking-tighter uppercase italic shadow-lg shadow-indigo-500/30">
                        {{ substr(auth()->user()->firstname, 0, 1) }}{{ substr(auth()->user()->lastname, 0, 1) }}
                    </div>
                    <div>
                        <span class="text-[10px] bg-indigo-500/20 px-2.5 py-0.5 text-indigo-400 rounded-md uppercase font-black tracking-wider">Membre Officiel</span>
                        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight uppercase italic mt-1">
                            {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                        </h1>
                        <p class="text-slate-400 text-xs font-mono mt-0.5">
                            <i class="fas fa-envelope text-indigo-400 mr-2"></i>{{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                <div class="bg-slate-900/80 border border-white/5 p-4 rounded-2xl min-w-[150px] text-center self-stretch sm:self-auto flex flex-col justify-center">
                    <span class="text-[9px] uppercase font-black tracking-widest text-slate-500 block">Solde Total</span>
                    <span class="text-4xl font-black text-white tracking-tight mt-0.5 block bg-gradient-to-r from-indigo-400 to-indigo-200 bg-clip-text text-transparent">
                        {{ auth()->user()->points }} <span class="text-xs text-slate-400 font-bold">PTS</span>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="glass-card-profile rounded-[2rem] p-6 flex flex-col justify-between group hover:border-amber-500/40 shadow-sm hover:shadow-md smooth-transition bg-white">
                <div>
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-500 text-xs font-bold"><i class="fas fa-coins"></i></div>
                    <p class="text-slate-400 text-[11px] font-extrabold uppercase tracking-wider mt-4">Points actuels</p>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">
                        {{ auth()->user()->points }} <span class="text-xs text-slate-400 font-bold">pts</span>
                    </h2>
                </div>
                <div class="text-[10px] text-slate-400 font-medium mt-4 italic">Prêts à être convertis.</div>
            </div>

            <div class="glass-card-profile rounded-[2rem] p-6 flex flex-col justify-between group hover:border-indigo-500/40 shadow-sm hover:shadow-md smooth-transition bg-white">
                <div>
                    <div class="w-9 h-9 rounded-xl bg-indigo-50/80 flex items-center justify-center text-indigo-600 text-xs"><i class="fas fa-id-badge"></i></div>
                    <p class="text-slate-400 text-[11px] font-extrabold uppercase tracking-wider mt-4">Niveau de Compte</p>

                    <h2 class="text-2xl font-black tracking-tight text-slate-900 mt-1.5 uppercase italic">
                        @if(auth()->user()->points >= 1000)
                            <span class="text-amber-500 drop-shadow-sm">🥇 Gold Tier</span>
                        @elseif(auth()->user()->points >= 500)
                            <span class="text-slate-500">🥈 Silver Tier</span>
                        @else
                            <span class="text-amber-700">🥉 Bronze Tier</span>
                        @endif
                    </h2>
                </div>
                <div class="mt-4 w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-indigo-600 h-full rounded-full smooth-transition" style="width: {{ min((auth()->user()->points / 1000) * 100, 100) }}%"></div>
                </div>
            </div>

            <div class="glass-card-profile rounded-[2rem] p-6 flex flex-col justify-between group hover:border-emerald-500/40 shadow-sm hover:shadow-md smooth-transition bg-white relative overflow-hidden">
                <div>
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 text-xs"><i class="fas fa-gift"></i></div>
                    <p class="text-slate-400 text-[11px] font-extrabold uppercase tracking-wider mt-4">Récompense dispo</p>
                    <h2 class="text-xl font-black text-emerald-600 mt-2">
                        {{ auth()->user()->points }} Points
                    </h2>
                </div>
                
                <a href="{{ route('rewards.index') }}"
                   class="inline-flex items-center justify-center gap-1.5 mt-4 bg-emerald-50 border border-emerald-100 hover:bg-emerald-600 hover:text-white text-emerald-600 w-full py-2.5 rounded-xl text-xs font-black transition-all duration-300">
                    <span>Voir Market</span> <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

        </div>

        <div class="glass-card-profile rounded-[2.5rem] p-6 sm:p-8 shadow-sm bg-white">
            
            <div class="flex justify-between items-center border-b border-slate-100 pb-5 mb-6">
                <div class="flex items-center gap-2.5">
                    <span class="text-indigo-600 text-xs"><i class="fas fa-sliders-h"></i></span>
                    <h2 class="text-base font-black text-slate-900 uppercase tracking-tight">
                        Informations personnelles
                    </h2>
                </div>

                <a href="{{ route('profile.show') }}"
                   class="inline-flex items-center justify-center gap-1.5 bg-slate-50 border border-slate-200/60 hover:bg-indigo-50 hover:text-indigo-600 text-slate-600 px-4 py-2 rounded-xl text-xs font-black smooth-transition hover:-translate-y-0.5">
                    <i class="fas fa-user-edit text-[10px]"></i> Modifier
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 font-medium">
                
                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl">
                    <span class="text-slate-400 text-[10px] uppercase font-extrabold tracking-wider block">Prénom</span>
                    <p class="text-slate-900 text-sm font-bold mt-1">{{ auth()->user()->firstname }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl">
                    <span class="text-slate-400 text-[10px] uppercase font-extrabold tracking-wider block">Nom</span>
                    <p class="text-slate-900 text-sm font-bold mt-1">{{ auth()->user()->lastname }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl sm:col-span-2">
                    <span class="text-slate-400 text-[10px] uppercase font-extrabold tracking-wider block">Email</span>
                    <p class="text-slate-900 text-sm font-bold font-mono mt-1">{{ auth()->user()->email }}</p>
                </div>

                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl sm:col-span-2">
                    <span class="text-slate-400 text-[10px] uppercase font-extrabold tracking-wider block">Téléphone</span>
                    <p class="text-slate-900 text-sm font-bold mt-1">
                        {{ auth()->user()->phone ?? 'Aucun contact lié' }}
                    </p>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection