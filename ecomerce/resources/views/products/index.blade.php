<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroPro Store - Blade Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { background-color: #020617; }
        .glass-card {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>
<body class="text-slate-300 antialiased font-sans p-6 sm:p-12 relative overflow-x-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[160px] pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[-10%] w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto space-y-12 relative z-10">

        <!-- HEADER -->
        <header class="text-center space-y-3">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-black uppercase tracking-[0.25em] mx-auto shadow-sm">
                ⚡ MyShop
            </div>
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tighter italic uppercase">
                My <span class="text-blue-500 not-italic">Shop</span>
            </h1>
            <p class="text-slate-500 text-sm max-w-md mx-auto">
                Explore next-gen static computing hardware assets with instant high precision filtration modules.
            </p>

            <!-- CART ICON -->
            <div class="flex justify-center mt-4">
                <a href="{{ route('cart.index') }}"
                    class="inline-flex items-center gap-2 bg-slate-900/60 border border-white/10 hover:border-blue-500/30 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                    🛒 Panier
                    @php $cartCount = collect(session('cart', []))->sum('quantity') @endphp
                    @if($cartCount > 0)
                        <span class="bg-blue-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <!-- FLASH MESSAGES -->
        @if(session('success'))
            <div class="max-w-xl mx-auto bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-2xl text-sm text-center">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-xl mx-auto bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-2xl text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- SEARCH + FILTERS -->
        <div class="space-y-6">
            <div class="max-w-xl mx-auto relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-500"></div>
                <div class="relative bg-[#0f172a]/80 backdrop-blur-md rounded-2xl flex items-center px-4 border border-white/5 shadow-inner">
                    <span class="mr-3 text-sm text-blue-400"><i class="fas fa-search"></i></span>
                    <input
                        id="searchInput"
                        type="text"
                        placeholder="Search components by brand name..."
                        class="w-full py-4 bg-transparent border-none text-white text-sm focus:outline-none placeholder-slate-500"
                    />
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2" id="categoryFilters">
                <button
                    data-category="all"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-blue-600 text-white border-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.3)]"
                >
                    🕹️ All Categories
                </button>
                @foreach($categories as $categorie)
                <button
                    data-category="{{ strtolower($categorie->name) }}"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white"
                >
                    {{ $categorie->name }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- PRODUCTS GRID -->
        <div id="productsGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($products as $product)
            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 transition-all duration-500"
                data-name="{{ strtolower($product->name) }}"
                data-category="{{ strtolower($product->category->name ?? 'all') }}">

                <!-- IMAGE -->
                <div class="relative w-full aspect-square bg-[#020617] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain w-full h-full">
                </div>

                <div class="space-y-4">
                    <!-- CATEGORY + STARS -->
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-600/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10">
                            {{ $product->category->name ?? '—' }}
                        </span>
                        <div class="flex text-yellow-500 text-[9px]">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>

                    <!-- NAME -->
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">
                        {{ $product->name }}
                    </h2>

                    <!-- DESCRIPTION -->
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed">{{ $product->description }}</p>

                    <!-- PRICE + ADD TO CART -->
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <span class="text-white font-black text-sm">{{ $product->price }} DH</span>

                        @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="w-14 bg-slate-800 text-white text-center rounded-xl py-2 text-xs border border-white/10 focus:outline-none">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider">
                                🛒 Buy Now
                            </button>
                        </form>
                        @else
                        <span class="text-red-400 text-xs font-black uppercase">Rupture de stock</span>
                        @endif
                    </div>

                    <!-- STOCK BADGE -->
                    <p class="text-[10px] {{ $product->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ $product->stock > 0 ? '✓ En stock (' . $product->stock . ')' : '✗ Rupture de stock' }}
                    </p>
                </div>
            </div>

            @empty
            <div class="col-span-3 text-center py-20">
                <h2 class="text-xl font-black text-white uppercase">Le stock est vide</h2>
            </div>
            @endforelse

        </div>

        <!-- NO RESULTS -->
        <div id="noProducts" class="hidden text-center py-24 bg-[#0f172a]/20 border border-white/5 rounded-[3rem] backdrop-blur-sm max-w-2xl mx-auto">
            <div class="text-4xl mb-4">🛸</div>
            <h3 class="text-lg font-bold text-white uppercase italic">Zero Catalog Matches</h3>
            <p class="text-slate-500 text-xs max-w-xs mx-auto mt-1">
                We couldn't track down any active components targeting those exact configuration strings.
            </p>
        </div>

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
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.classList.add('hidden');
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
            btn.addEventListener('click', () => {
                categoryButtons.forEach(b => {
                    b.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white";
                });

                btn.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-blue-600 text-white border-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.3)]";

                currentCategory = btn.getAttribute('data-category');
                filterCatalog();
            });
        });
    </script>
</body>
</html>