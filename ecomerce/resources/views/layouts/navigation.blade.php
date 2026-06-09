<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc; /* Beautiful slate light background */
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen antialiased relative overflow-x-hidden">

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[300px] bg-indigo-500/5 rounded-full blur-[100px] pointer-events-none z-0"></div>

    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <div class="flex items-center">
                    <a href="/" class="font-black text-2xl tracking-tighter text-slate-900 hover:opacity-80 transition-opacity flex items-center gap-2">
                        <span class="text-indigo-600 text-xl">⚡</span>MyShop
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-1 font-bold text-sm text-slate-600">
                    @auth
                        @if(auth()->user()->role->name === 'Admin')
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-chart-pie mr-2 text-indigo-500"></i>Dashboard</a>
                            <a href="{{ route('productsadmin') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-box mr-2 text-indigo-500"></i>Products</a>
                            <a href="{{ route('clients') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-users mr-2 text-indigo-500"></i>Clients</a>
                            <a href="{{ route('orders') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-shopping-bag mr-2 text-indigo-500"></i>Orders</a>
                        @elseif(auth()->user()->role->name === 'Client')
                            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-store mr-2 text-indigo-500"></i>Products</a>
                            <a href="{{ route('order.my') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-box-open mr-2 text-indigo-500"></i>My Orders</a>
                            <a href="{{ route('cart.index') }}" class="px-4 py-2 rounded-xl hover:text-indigo-600 hover:bg-slate-100 transition-all"><i class="fas fa-shopping-cart mr-2 text-indigo-500"></i>Cart</a>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <div class="text-right hidden sm:block">
                            <p class="font-extrabold text-sm text-slate-900 leading-tight">
                                {{ auth()->user()->name ?? auth()->user()->email }}
                            </p>
                            <p class="text-[11px] font-black tracking-wider text-indigo-600 uppercase mt-0.5">
                                <i class="fas fa-star mr-1"></i>{{ auth()->user()->points ?? 0 }} PTS
                            </p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 border border-indigo-100 hover:bg-indigo-600 hover:text-white text-xs font-black rounded-xl transition-all duration-300 hover:-translate-y-0.5">
                            <i class="fas fa-user-circle text-sm"></i> <span>Profile</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 bg-slate-100 border border-slate-200/60 hover:border-red-200 hover:text-red-500 text-slate-500 rounded-xl transition-all duration-300">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-black rounded-xl shadow-lg shadow-indigo-600/10 transition-all duration-300 hover:-translate-y-0.5 uppercase tracking-wider">
                            Login <i class="fas fa-arrow-right ml-1.5"></i>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <main class="py-8 relative z-10">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

</body>
</html>