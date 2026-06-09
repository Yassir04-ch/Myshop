<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop | Premium E-commerce Experience</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .animated-mesh {
            background-color: #ffffff;
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,0) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.05) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.05) 0, transparent 50%);
        }
    </style>
</head>

<body class="bg-slate-50/50 antialiased animated-mesh min-h-screen">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

        <a href="/" class="group flex items-center gap-2 text-2xl font-extrabold tracking-tight text-slate-900">
            <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent group-hover:opacity-80 transition-opacity">MyShop</span>
            <span class="h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
        </a>

        <div class="hidden md:flex items-center space-x-8">
            <a href="/" class="text-sm font-medium text-slate-600 hover:text-indigo-600 relative after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 hover:after:w-full after:bg-indigo-600 after:transition-all after:duration-300">Home</a>
            <a href="/profile" class="text-sm font-medium text-slate-600 hover:text-indigo-600 relative after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 hover:after:w-full after:bg-indigo-600 after:transition-all after:duration-300">profile</a>
            <a href="/products" class="text-sm font-medium text-slate-600 hover:text-indigo-600 relative after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 hover:after:w-full after:bg-indigo-600 after:transition-all after:duration-300">Products</a>
            <a href="/categories" class="text-sm font-medium text-slate-600 hover:text-indigo-600 relative after:absolute after:bottom-[-4px] after:left-0 after:h-[2px] after:w-0 hover:after:w-full after:bg-indigo-600 after:transition-all after:duration-300">Categories</a>
        </div>

        <div class="flex items-center gap-4">
            @auth
              @if(auth()->user()->role->name == "Admin")
                <a href="/dashboard" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
                    Dashboard
                </a>
               @endif
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button class="text-sm font-medium text-slate-500 hover:text-rose-600 border border-slate-200 hover:border-rose-100 rounded-xl px-4 py-2 transition-all duration-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">
                    Login
                </a>

                <a href="/register" class="bg-slate-950 text-white text-sm font-medium px-5 py-2.5 rounded-xl hover:bg-indigo-600 shadow-sm shadow-slate-950/10 hover:shadow-indigo-600/20 transform hover:-translate-y-0.5 transition-all duration-300">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<section class="relative overflow-hidden pt-24 pb-20 px-6 max-w-7xl mx-auto flex flex-col items-center text-center">
    
    <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide mb-6 animate-fade-in">
        <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-ping"></span>
        New Season Drops Are Live
    </div>

    <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight max-w-3xl leading-[1.15]">
        Elevate Your Style with <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">MyShop</span>
    </h1>

    <p class="mt-6 text-lg text-slate-500 max-w-xl leading-relaxed">
        Discover curated premium collections with blazing fast delivery, secure payment options, and 24/7 client support.
    </p>

    <div class="mt-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto justify-center">
        <a href="/products"
           class="group bg-indigo-600 text-white font-medium px-8 py-4 rounded-xl shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/35 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
            <span>Explore Products</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>

        <a href="/categories"
           class="bg-white text-slate-700 font-medium px-8 py-4 rounded-xl border border-slate-200/80 shadow-sm hover:bg-slate-50 transform hover:-translate-y-1 transition-all duration-300">
            Browse Categories
        </a>
    </div>
</section>

<section class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 px-6 pb-24">

    <div class="group bg-white p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl hover:shadow-indigo-600/[0.03] transform hover:-translate-y-2 transition-all duration-300">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        <h3 class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors">Fast Delivery</h3>
        <p class="text-slate-500 mt-2 text-sm leading-relaxed">We package and dispatch your premium products with local tracking in record timings.</p>
    </div>

    <div class="group bg-white p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl hover:shadow-indigo-600/[0.03] transform hover:-translate-y-2 transition-all duration-300">
        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 mb-6 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="font-bold text-slate-800 text-lg group-hover:text-purple-600 transition-colors">Best Prices</h3>
        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Affordable premium products and direct wholesale pricing tier options for everybody.</p>
    </div>

    <div class="group bg-white p-8 rounded-2xl border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl hover:shadow-indigo-600/[0.03] transform hover:-translate-y-2 transition-all duration-300">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        <h3 class="font-bold text-slate-800 text-lg group-hover:text-emerald-600 transition-colors">Secure Payment</h3>
        <p class="text-slate-500 mt-2 text-sm leading-relaxed">Your data safety matters. 100% encrypted checkout systems backed by reliable layers.</p>
    </div>

</section>

</body>
</html>