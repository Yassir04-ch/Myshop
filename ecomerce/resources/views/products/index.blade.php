<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroPro Store - Blade Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { background-color: #030712; }
        .glass-card {
            background: rgba(17, 24, 39, 0.45);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.03);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        
        /* ─── ANIMATIONS & SWEEP EFFECT ─── */
        @keyframes subtle-float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(0.3deg); }
        }
        .animate-float {
            animation: subtle-float 5s ease-in-out infinite;
        }

        /* Laser Sweep Animation travelling horizontally above product details */
        @keyframes laser-sweep {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }
        .animate-sweep {
            animation: laser-sweep 3.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        
        .smooth-transition {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-slate-300 antialiased font-sans p-6 sm:p-12 relative overflow-x-hidden selection:bg-blue-500/20 selection:text-blue-200">

    <!-- Ambient premium lighting glows behind -->
    <div class="absolute top-[-5%] left-[-5%] w-[700px] h-[700px] bg-blue-600/10 rounded-full blur-[180px] pointer-events-none animate-pulse" style="animation-duration: 9s;"></div>
    <div class="absolute bottom-[15%] right-[-5%] w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[160px] pointer-events-none animate-pulse" style="animation-duration: 14s;"></div>

    <div class="max-w-7xl mx-auto space-y-12 relative z-10">

        <!-- HEADER -->
        <header class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/5 border border-blue-500/10 text-blue-400 text-[10px] font-black uppercase tracking-[0.25em] mx-auto shadow-sm transform hover:scale-105 transition-transform duration-300 cursor-pointer">
                ⚡ MyShop
            </div>
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tighter italic uppercase">
                My <span class="text-blue-500 not-italic inline-block hover:scale-105 transition-transform duration-300 cursor-default">Shop</span>
            </h1>
            <p class="text-slate-500 text-sm max-w-md mx-auto">
                Explore next-gen static computing hardware assets with instant high precision filtration modules.
            </p>

            <div class="flex items-center justify-center gap-3 mt-6">
                <a href="{{ route('order.my') }}"
                    class="group relative inline-flex items-center gap-2 bg-slate-900/40 border border-white/5 hover:border-indigo-500/30 text-slate-400 hover:text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider shadow-lg transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                    <span class="absolute inset-0 bg-indigo-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <i class="fas fa-box-open text-indigo-400 group-hover:scale-110 transition-transform duration-300"></i>
                    <span>Voir mes commandes</span>
                </a>

                <!-- CART BUTTON -->
                <a href="{{ route('cart.index') }}"
                    class="group inline-flex items-center gap-2 bg-blue-600/10 border border-blue-500/20 hover:border-blue-500/50 hover:bg-blue-600 text-blue-400 hover:text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                    <i class="fas fa-shopping-cart group-hover:rotate-12 transition-transform duration-300"></i>
                    <span>Panier</span>
                    @php $cartCount = collect(session('cart', []))->sum('quantity') @endphp
                    @if($cartCount > 0)
                        <span class="bg-blue-600 group-hover:bg-white text-white group-hover:text-black text-[10px] font-black px-2 py-0.5 rounded-full animate-bounce smooth-transition">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        @if(session('success'))
            <div class="max-w-xl mx-auto bg-green-500/5 border border-green-500/20 text-green-400 px-4 py-3 rounded-2xl text-sm text-center shadow-lg shadow-green-500/5">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-xl mx-auto bg-red-500/5 border border-red-500/20 text-red-400 px-4 py-3 rounded-2xl text-sm text-center shadow-lg shadow-red-500/5">
                {{ session('error') }}
            </div>
        @endif

        <!-- SEARCH + FILTERS -->
        <div class="space-y-6">
            <div class="max-w-xl mx-auto relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-700"></div>
                <form method="GET" action="{{ route('products.index') }}" id="searchForm">
                    <div class="relative bg-[#0f172a]/70 backdrop-blur-md rounded-2xl flex items-center px-4 border border-white/5 shadow-inner group-hover:border-blue-500/20 transition-colors duration-500">
                        <span class="mr-3 text-sm text-blue-400 group-hover:scale-110 transition-transform duration-300"><i class="fas fa-search"></i></span>
                        <input
                            id="searchInput"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search components by brand name..."
                            class="w-full py-4 bg-transparent border-none text-white text-sm focus:outline-none placeholder-slate-600"
                        />
                    </div>
                </form>     
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2" id="categoryFilters">
               <a href="{{ route('products.index')}}" class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-950/40 text-slate-400 border-white/5 hover:border-blue-500/20 hover:text-white hover:-translate-y-0.5">
                    🕹️ All Categories
                </a>
                @foreach($categories as $categorie)
                <a href="{{ route('products.index', ['category' => strtolower($categorie->name), 'search' => request('search')]) }}"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-500 border hover:-translate-y-0.5
                    {{ request('category') === strtolower($categorie->name) 
                        ? 'bg-blue-600 text-white border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.2)]' 
                        : 'bg-slate-950/40 text-slate-400 border-white/5 hover:border-blue-500/20 hover:text-white' }}">
                    {{ $categorie->name }}
                </a>
                @endforeach 
            </div>
        </div>

        <!-- PRODUCTS GRID -->
        <div id="productsGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($products as $product)
            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 hover:shadow-[0_25px_50px_rgba(59,130,246,0.04)] hover:-translate-y-2 smooth-transition relative overflow-hidden"
                data-name="{{ strtolower($product->name) }}"
                data-category="{{ strtolower($product->category->name ?? 'all') }}">
                
                <!-- Moving Cyan/Blue Laser sweep across individual product cards -->
                <div class="absolute top-0 left-0 w-1/2 h-[2px] bg-gradient-to-r from-transparent via-blue-400 to-transparent opacity-0 group-hover:opacity-100 pointer-events-none animate-sweep"></div>
                
                <!-- Inner Neon Back-spotlight behind main container frame -->
                <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-40 h-40 bg-blue-500/0 group-hover:bg-blue-500/10 rounded-full blur-[60px] pointer-events-none smooth-transition"></div>

                <!-- IMAGE CASE CONTAINER WITH OVERFLOW GLOW UPGRADE -->
                <div class="relative w-full aspect-square bg-[#090d16] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6 group-hover:border-blue-500/20 smooth-transition">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="object-contain w-full h-full transform group-hover:scale-105 group-hover:rotate-1 smooth-transition animate-float">
                </div>

                <div class="space-y-4 relative z-10">
                    <!-- CATEGORY + STARS -->
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-950 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10 group-hover:bg-blue-600 group-hover:text-white smooth-transition">
                            {{ $product->category->name ?? '—' }}
                        </span>
                        <div class="flex text-amber-500 text-[9px] gap-0.5">
                            <i class="fas fa-star transform group-hover:scale-110 smooth-transition" style="transition-delay: 40ms;"></i>
                            <i class="fas fa-star transform group-hover:scale-110 smooth-transition" style="transition-delay: 80ms;"></i>
                            <i class="fas fa-star transform group-hover:scale-110 smooth-transition" style="transition-delay: 120ms;"></i>
                            <i class="fas fa-star transform group-hover:scale-110 smooth-transition" style="transition-delay: 160ms;"></i>
                            <i class="fas fa-star transform group-hover:scale-110 smooth-transition" style="transition-delay: 200ms;"></i>
                        </div>
                    </div>

                    <!-- NAME -->
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">
                        {{ $product->name }}
                    </h2>

                    <!-- DESCRIPTION -->
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed group-hover:text-slate-400 transition-colors duration-300">{{ $product->description }}</p>

                    <!-- COMPONENT SEPARATOR LINE WITH OPTIONAL Sweep trigger -->
                    <div class="h-[1px] w-full bg-white/5 relative overflow-hidden mt-2">
                        <!-- Horizontal Laser strip right inside details divider -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/50 to-transparent -translate-x-full group-hover:animate-sweep"></div>
                    </div>

                    <!-- PRICE + ADD TO CART -->
                    <div class="flex items-center justify-between pt-2">
                        <span class="text-white font-black text-lg tracking-tight group-hover:text-blue-300 smooth-transition">{{ $product->price }} DH</span>

                        @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="w-12 bg-slate-900/90 text-white text-center rounded-xl py-2 text-xs border border-white/5 focus:border-blue-500/40 focus:outline-none smooth-transition">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider shadow-md hover:shadow-lg active:scale-95 transform">
                                🛒 Buy
                            </button>
                        </form>
                        @else
                        <span class="text-red-400/80 text-[10px] font-black uppercase tracking-wider bg-red-500/5 px-3 py-1 rounded-lg border border-red-500/10 animate-pulse">Rupture</span>
                        @endif
                    </div>

                    <!-- STOCK BADGE -->
                    <p class="text-[10px] flex items-center gap-1 {{ $product->stock > 0 ? 'text-green-500/90' : 'text-red-400/80' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $product->stock > 0 ? 'bg-green-500 animate-ping' : 'bg-red-500' }}"></span>
                        {{ $product->stock > 0 ? 'En stock (' . $product->stock . ')' : 'Rupture de stock' }}
                    </p>
                </div>
            </div>

            @empty
            <div class="col-span-3 text-center py-20 bg-slate-900/10 border border-slate-900 rounded-[2.5rem]">
                <h2 class="text-xl font-black text-slate-600 uppercase tracking-widest">Le stock est vide</h2>
            </div>
            @endforelse

        </div>

        <!-- NO RESULTS -->
        <div id="noProducts" class="hidden text-center py-24 bg-[#0f172a]/20 border border-white/5 rounded-[3rem] backdrop-blur-sm max-w-2xl mx-auto transform transition-all duration-500">
            <div class="text-4xl mb-4 animate-bounce">🛸</div>
            <h3 class="text-lg font-bold text-white uppercase italic">Zero Catalog Matches</h3>
            <p class="text-slate-500 text-xs max-w-xs mx-auto mt-1">
                We couldn't track down any active components targeting those exact configuration strings.
            </p>
        </div>

    </div>
    
    <div class="flex justify-center mt-12 mb-6">
         {{ $products->links() }}
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const categoryButtons = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');
        const noProductsMessage = document.getElementById('noProducts');

        let currentCategory = 'all';
        let currentSearch = '';

        function filterCatalog() {
            let visibleCount = 0;

            productCards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const category = card.getAttribute('data-category');

                const matchesSearch = name.includes(currentSearch);
                const matchesCategory = currentCategory === 'all' || category === currentCategory;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.classList.remove('opacity-0', 'scale-95');
                    }, 10);
                    visibleCount++;
                } else {
                    card.classList.add('opacity-0', 'scale-95');
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noProductsMessage.classList.remove('hidden');
            } else {
                noProductsMessage.classList.add('hidden');
            }
        }

        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase();
            filterCatalog();
        });

        categoryButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if(!btn.hasAttribute('data-category')) return; 
                
                e.preventDefault();
                categoryButtons.forEach(b => {
                    b.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-500 border bg-slate-950/40 text-slate-400 border-white/5 hover:border-blue-500/20 hover:text-white hover:-translate-y-0.5";
                });

                btn.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-500 border bg-blue-600 text-white border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.2)] hover:-translate-y-0.5";

                currentCategory = btn.getAttribute('data-category');
                filterCatalog();
            });
        });
    </script>
</body>
</html>