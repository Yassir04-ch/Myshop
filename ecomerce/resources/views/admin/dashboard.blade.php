<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Modern Dark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800,900&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0f19] text-slate-200 min-h-screen relative overflow-x-hidden selection:bg-violet-500/30 selection:text-violet-200">

    <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-violet-600/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-10 left-1/4 w-[400px] h-[400px] bg-emerald-600/5 rounded-full blur-[100px] pointer-events-none"></div>

    <nav class="bg-[#111827]/80 backdrop-blur-xl border-b border-slate-800/80 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="bg-violet-600 p-2 rounded-xl shadow-md shadow-violet-600/10">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                </svg>
            </div>
            <span class="text-lg font-black tracking-wider text-white uppercase">Admin<span class="text-violet-500">Panel</span></span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-2 bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white px-4 py-2 rounded-xl transition-all duration-300 font-bold text-xs uppercase tracking-wider shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M19.5 12l-3-3m3 3l-3 3m3-3H9"></path>
                </svg>
                Logout
            </a>
        </form>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-12 md:py-20 relative z-10">
        <header class="mb-14 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-black text-white mb-3 tracking-tight">Tableau de Bord</h1>
            <p class="text-slate-400 text-base font-medium max-w-xl">Bienvenue, Admin. Gérez votre boutique, suivez vos activités et modifiez vos configurations en un seul clic.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            
            <a href="{{route('productsadmin')}}" class="group relative bg-[#111827] border border-slate-800/80 p-8 rounded-[2rem] overflow-hidden hover:border-violet-500/50 hover:shadow-2xl hover:shadow-violet-500/5 transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between min-h-[280px]">
                <div class="absolute -right-6 -bottom-6 text-slate-800/20 group-hover:text-violet-500/10 transition-all duration-500">
                    <svg class="w-36 h-36" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                    </svg>
                </div>
                
                <div>
                    <div class="bg-violet-500/10 text-violet-400 w-12 h-12 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-violet-500 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h12M6 10h12M6 14h12M6 18h12"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 tracking-tight">Product Management</h3>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-[240px]">Ajoutez, modifiez ou supprimez vos articles et catégories.</p>
                </div>

                <div class="mt-6 flex items-center text-violet-400 font-bold text-xs uppercase tracking-widest gap-2">
                    Explorer 
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                    </svg>
                </div>
            </a>

            <a href="/users" class="group relative bg-[#111827] border border-slate-800/80 p-8 rounded-[2rem] overflow-hidden hover:border-blue-500/50 hover:shadow-2xl hover:shadow-blue-500/5 transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between min-h-[280px]">
                <div class="absolute -right-6 -bottom-6 text-slate-800/20 group-hover:text-blue-500/10 transition-all duration-500">
                    <svg class="w-36 h-36" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                    </svg>
                </div>

                <div>
                    <div class="bg-blue-500/10 text-blue-400 w-12 h-12 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774a1.125 1.125 0 01.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738a1.125 1.125 0 01-.12 1.45l-.773.773a1.125 1.125 0 01-1.45.12l-.737-.527c-.35-.25-.806-.272-1.204-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527a1.125 1.125 0 01-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.398-.165.71-.505.78-.929l.15-.894z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 tracking-tight">Users</h3>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-[240px]">Gérez les comptes clients et les permissions du staff.</p>
                </div>

                <div class="mt-6 flex items-center text-blue-400 font-bold text-xs uppercase tracking-widest gap-2">
                    Explorer 
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                    </svg>
                </div>
            </a>

            <a href="/order" class="group relative bg-[#111827] border border-slate-800/80 p-8 rounded-[2rem] overflow-hidden hover:border-emerald-500/50 hover:shadow-2xl hover:shadow-emerald-500/5 transition-all duration-500 hover:-translate-y-1.5 flex flex-col justify-between min-h-[280px]">
                <div class="absolute -right-6 -bottom-6 text-slate-800/20 group-hover:text-emerald-500/10 transition-all duration-500">
                    <svg class="w-36 h-36" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5A3.375 3.375 0 0010.125 2.25H9.75m0 18.75h-2.125a3.375 3.375 0 01-3.375-3.375V4.625c0-.955.393-1.82 1.034-2.446M21.75 12c0 4.142-3.358 7.5-7.5 7.5a7.5 7.5 0 01-7.5-7.5c0-4.142 3.358-7.5 7.5-7.5a7.5 7.5 0 017.5 7.5z"></path>
                    </svg>
                </div>

                <div>
                    <div class="bg-emerald-500/10 text-emerald-400 w-12 h-12 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5A3.375 3.375 0 0010.125 2.25H9.75m0 18.75h-3.375a3.375 3.375 0 01-3.375-3.375V4.625c0-.955.393-1.82 1.034-2.446M8.25 21.75h7.5c1.035 0 1.875-.84 1.875-1.875v-7.5c0-1.035-.84-1.875-1.875-1.875h-7.5c-1.035 0-1.875.84-1.875 1.875v7.5c0 1.035.84 1.875 1.875 1.875z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2 tracking-tight">Orders</h3>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-[240px]">Suivez les ventes en temps réel et changez les status.</p>
                </div>

                <div class="mt-6 flex items-center text-emerald-400 font-bold text-xs uppercase tracking-widest gap-2">
                    Explorer 
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                    </svg>
                </div>
            </a>

        </div>
    </div>
</body>
</html>