<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop | Premium E-commerce Experience</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .light-mesh {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, hsla(220,100%,97%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(243,100%,95%,0.6) 0, transparent 40%), 
                radial-gradient(at 100% 100%, hsla(210,100%,96%,1) 0, transparent 50%);
        }

        .product-track {
            display: flex;
            gap: 1.5rem;
            width: max-content;
            animation: scrollProducts 35s linear infinite;
        }

        .product-track:hover {
            animation-play-state: paused;
        }

        @keyframes scrollProducts {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>

<body class="light-mesh text-slate-700 antialiased min-h-screen selection:bg-blue-600/10 selection:text-blue-900">

{{-- NAVBAR --}}
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/60 h-20 px-6 flex justify-between items-center shadow-sm shadow-slate-100/50">

    <a href="/" class="group flex items-center gap-2 text-2xl font-black tracking-tighter text-slate-900">
        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent group-hover:opacity-80 transition-opacity">MyShop</span>
        <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse shadow-[0_0_8px_rgba(37,99,235,0.5)]"></span>
    </a>

    <div class="hidden md:flex items-center space-x-8">
        <a href="/" class="text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-blue-600 transition-colors">Home</a>
        <a href="/products" class="text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-blue-600 transition-colors">Products</a>
    </div>

    <div class="flex gap-4 items-center">
        @auth
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 text-xs font-black shadow-inner">
                <i class="fas fa-bolt text-amber-500 animate-bounce"></i>
                <span>{{ auth()->user()->points ?? 0 }} <span class="text-[9px] font-bold text-amber-600/80">PTS</span></span>
            </div>

            <form method="POST" action="/logout" class="inline">
                @csrf
                <button class="text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-rose-600 border border-slate-200 hover:border-rose-200 rounded-xl px-4 py-2.5 bg-white transition-all shadow-sm">
                    Logout
                </button>
            </form>
        @else
            <a href="/login" class="text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-blue-600 transition-colors">Login</a>
            <a href="/register" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xs font-black uppercase tracking-widest px-5 py-3 rounded-xl hover:opacity-95 shadow-md shadow-blue-600/10 transform active:scale-95 transition-all">
                Register
            </a>
        @endauth
    </div>

</nav>

{{-- HERO --}}
<section class="relative overflow-hidden pt-24 pb-16 px-6 max-w-7xl mx-auto flex flex-col items-center text-center">
    
    <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase mb-6">
        <span class="flex h-1.5 w-1.5 rounded-full bg-blue-600 animate-ping"></span>
        New Drops Are Live 2026
    </div>

    <h1 class="text-4xl md:text-7xl font-black text-slate-900 tracking-tighter max-w-4xl leading-[1.05] uppercase italic">
        Discover Premium <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-indigo-700 bg-clip-text text-transparent not-italic">Products</span>
    </h1>
    
    <p class="mt-6 text-xs sm:text-sm text-slate-400 font-medium max-w-lg leading-relaxed tracking-wide">
        Best tech deals & rewards system built for the next generation inside Morocco.
    </p>

    <a href="/products"
       class="mt-10 inline-flex bg-slate-900 text-white text-xs font-black uppercase tracking-widest px-8 py-4 rounded-xl shadow-lg shadow-slate-900/10 hover:bg-slate-800 transform active:scale-95 transition-all">
        Explore Now <i class="fas fa-chevron-right text-[9px] ml-2 mt-0.5"></i>
    </a>
</section>

{{-- PRODUCTS CAROUSEL --}}
<section class="w-full overflow-hidden py-10 bg-white border-y border-slate-200/60">

    <div class="max-w-7xl mx-auto px-6 mb-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <h2 class="text-xs font-black text-slate-900 uppercase tracking-widest">
                🔥 Hot Drops & Trends
            </h2>
        </div>
        <span class="text-[9px] font-black tracking-widest uppercase text-blue-600 bg-blue-50 border border-blue-100 px-2.5 py-1 rounded-md"><i class="fas fa-fire mr-1 text-orange-500"></i> Points Boosted</span>
    </div>

    <div class="relative w-full overflow-hidden flex">
        
        @if(count($products) > 0)
            <div class="product-track px-4">
                
                {{-- First loop sequence --}}
                @foreach($products as $product)
                    <div class="w-[290px] bg-slate-50/40 border border-slate-200/80 rounded-2xl p-4 shrink-0 group smooth-transition hover:border-blue-300 hover:bg-white hover:shadow-md hover:shadow-blue-600/5">
                        
                        {{-- IMAGE --}}
                        <div class="h-44 bg-white border border-slate-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden relative shadow-inner">
                            <span class="absolute top-2 left-2 bg-blue-600 text-white text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded shadow-sm">
                                +{{ $product->reward_points ?? 0 }} PTS
                            </span>

                            @if($product->images && $product->images->count())
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="w-full h-full object-cover group-hover:scale-105 smooth-transition">
                            @else
                                <div class="flex items-center justify-center h-full text-slate-300 text-4xl group-hover:text-blue-600 smooth-transition">
                                    <i class="fas fa-box"></i>
                                </div>
                            @endif
                        </div>

                        {{-- NAME --}}
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider truncate">
                            {{ $product->name }}
                        </h3>

                        {{-- PRICE + STOCK --}}
                        <div class="flex justify-between items-center mt-3 text-xs border-t border-slate-100 pt-3">
                            <span class="text-sm font-black text-blue-600">
                                {{ number_format($product->price, 2) }} DH
                            </span>
                            <span class="text-[10px] text-slate-400 font-bold bg-slate-100 px-2 py-0.5 rounded">
                                Stock: {{ $product->stock }}
                            </span>
                        </div>
                    </div>
                @endforeach

                {{-- Mirror Duplicate sequence for infinite loop continuity --}}
                @foreach($products as $product)
                    <div class="w-[290px] bg-slate-50/40 border border-slate-200/80 rounded-2xl p-4 shrink-0 group smooth-transition hover:border-blue-300 hover:bg-white hover:shadow-md hover:shadow-blue-600/5">
                        <div class="h-44 bg-white border border-slate-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden relative shadow-inner">
                            <span class="absolute top-2 left-2 bg-blue-600 text-white text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded shadow-sm">
                                +{{ $product->reward_points ?? 0 }} PTS
                            </span>
                            @if($product->images && $product->images->count())
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-slate-300 text-4xl">
                                    <i class="fas fa-box"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider truncate">{{ $product->name }}</h3>
                        <div class="flex justify-between items-center mt-3 text-xs border-t border-slate-100 pt-3">
                            <span class="text-sm font-black text-blue-600">{{ number_format($product->price, 2) }} DH</span>
                            <span class="text-[10px] text-slate-400 font-bold bg-slate-100 px-2 py-0.5 rounded">Stock: {{ $product->stock }}</span>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="max-w-7xl mx-auto px-6 py-4">
                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">No active drops available 😢</p>
            </div>
        @endif

    </div>
</section>

{{-- FEATURES --}}
<section class="max-w-7xl mx-auto grid md:grid-cols-3 gap-6 px-6 pt-20 pb-24">

    <div class="group bg-white p-6 rounded-2xl border border-slate-200/60 hover:border-blue-500/40 shadow-sm transform hover:-translate-y-1 smooth-transition">
        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 smooth-transition">
            <i class="fas fa-truck-fast text-sm"></i>
        </div>
        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wider group-hover:text-blue-600 smooth-transition">Fast Delivery</h3>
        <p class="text-slate-400 mt-2 text-xs font-medium leading-relaxed">Quick and reliable shipping tracks straight onto your doorstep inside Morocco.</p>
    </div>

    <div class="group bg-white p-6 rounded-2xl border border-slate-200/60 hover:border-blue-500/40 shadow-sm transform hover:-translate-y-1 smooth-transition">
        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-4 group-hover:scale-110 smooth-transition">
            <i class="fas fa-tags text-sm"></i>
        </div>
        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wider group-hover:text-indigo-600 smooth-transition">Best Prices</h3>
        <p class="text-slate-400 mt-2 text-xs font-medium leading-relaxed">Unbeatable gaming and power-user gear direct wholesale value points tiering.</p>
    </div>

    <div class="group bg-white p-6 rounded-2xl border border-slate-200/60 hover:border-blue-500/40 shadow-sm transform hover:-translate-y-1 smooth-transition">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-4 group-hover:scale-110 smooth-transition">
            <i class="fas fa-shield-halved text-sm"></i>
        </div>
        <h3 class="font-black text-slate-900 text-sm uppercase tracking-wider group-hover:text-emerald-400 smooth-transition">Secure Payment</h3>
        <p class="text-slate-400 mt-2 text-xs font-medium leading-relaxed">Your digital safety matters. 100% layer encrypted checkout parameters.</p>
    </div>

</section>

{{-- 🚀 MODERN COMPACT FOOTER DIAL ENTREPRISE --}}
<footer class="bg-slate-900 text-slate-400 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-slate-800/80">
            
            <div class="md:col-span-5 space-y-4">
                <a href="/" class="flex items-center gap-2 text-xl font-extrabold tracking-tight text-white">
                    <span class="bg-gradient-to-r from-blue-400 to-indigo-400 bg-clip-text text-transparent">MyShop</span>
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                </a>
                <p class="text-xs text-slate-400 max-w-sm leading-relaxed">
                    La plateforme e-commerce premium pour la nouvelle génération au Maroc. Commandez en toute sécurité et accumulez des points bonus à chaque achat !
                </p>
                <div class="flex items-center gap-2.5 pt-1">
                    <a href="#" class="w-8 h-8 rounded-xl bg-slate-800 text-slate-300 hover:bg-blue-600 hover:text-white flex items-center justify-center text-xs smooth-transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-8 h-8 rounded-xl bg-slate-800 text-slate-300 hover:bg-blue-600 hover:text-white flex items-center justify-center text-xs smooth-transition"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="w-8 h-8 rounded-xl bg-slate-800 text-slate-300 hover:bg-blue-600 hover:text-white flex items-center justify-center text-xs smooth-transition"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="md:col-span-3 space-y-3">
                <h4 class="text-xs font-bold text-white uppercase tracking-widest">Liens Utiles</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="/products" class="hover:text-white smooth-transition">Boutique Drops</a></li>
                    <li><a href="/categories" class="hover:text-white smooth-transition">Nos Catégories</a></li>
                    <li><a href="#" class="hover:text-white smooth-transition">Devenir Partenaire</a></li>
                    <li><a href="#" class="hover:text-white smooth-transition">Conditions de Retour</a></li>
                </ul>
            </div>

            <div class="md:col-span-4 space-y-3">
                <h4 class="text-xs font-bold text-white uppercase tracking-widest">Contact Support</h4>
                <ul class="space-y-3 text-xs">
                    <li class="flex items-center gap-2.5 text-slate-300">
                        <i class="fas fa-phone text-blue-400 text-xs w-4"></i>
                        <span class="font-semibold">+212 600 000 000</span>
                    </li>
                    <li class="flex items-center gap-2.5 text-slate-300">
                        <i class="far fa-envelope text-indigo-400 text-xs w-4"></i>
                        <span class="font-semibold">support@myshop.ma</span>
                    </li>
                    <li class="flex items-start gap-2.5 text-slate-300">
                        <i class="fas fa-map-marker-alt text-emerald-400 text-xs w-4 mt-0.5"></i>
                        <span class="leading-relaxed">YouCode Campus, Quarter El Koudia,<br>El Jadida, Maroc</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-[11px] text-slate-500 font-medium">
            <p>&copy; 2026 MyShop S.A.R.L. Tous droits réservés.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-slate-300 smooth-transition">Termes & Conditions</a>
                <a href="#" class="hover:text-slate-300 smooth-transition">Confidentialité</a>
            </div>
        </div>

    </div>
</footer>

</body>
</html>