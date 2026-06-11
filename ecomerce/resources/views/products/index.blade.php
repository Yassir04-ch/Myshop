<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroPro Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f8fafc; } /* Slate 50 Premium Light Background */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.12);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        @keyframes subtle-float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(0.5deg); }
        }
        .animate-float {
            animation: subtle-float 6s ease-in-out infinite;
        }
        @keyframes laser-sweep {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }
        .animate-sweep {
            animation: laser-sweep 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        .smooth-transition {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-slate-700 antialiased font-sans p-4 sm:p-8 lg:p-12 relative overflow-x-hidden selection:bg-blue-600/10 selection:text-blue-900 pt-24">

    <div class="absolute top-[-5%] left-[-5%] w-[700px] h-[700px] bg-blue-500/5 rounded-full blur-[140px] pointer-events-none animate-pulse" style="animation-duration: 9s;"></div>
    <div class="absolute bottom-[15%] right-[-5%] w-[600px] h-[600px] bg-indigo-500/5 rounded-full blur-[140px] pointer-events-none animate-pulse" style="animation-duration: 14s;"></div>

    <nav class="fixed top-4 left-4 right-4 z-40 max-w-7xl mx-auto glass-card rounded-2xl px-4 py-3 flex items-center justify-between shadow-[0_10px_30px_rgba(148,163,184,0.12)] border border-slate-200/50">
        <a href="{{ route('products.index') }}" class="flex items-center gap-2 group">
            <span class="text-blue-600 text-lg group-hover:scale-110 transition-transform duration-300">⚡</span>
            <span class="font-black text-slate-900 tracking-tighter uppercase italic text-sm">
                ElectroPro <span class="text-blue-600 not-italic">Store</span>
            </span>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('order.my') }}"
                class="group relative inline-flex items-center gap-2 bg-slate-100/80 border border-slate-200 hover:border-slate-300 text-slate-600 hover:text-slate-900 px-3 py-2 rounded-xl text-xs font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-sm">
                <i class="fas fa-box-open text-indigo-500 group-hover:scale-110 transition-transform duration-300"></i>
                <span class="hidden sm:inline">Commandes</span>
            </a>

            <a href="{{ route('cart.index') }}"
                class="group inline-flex items-center gap-2 bg-blue-600 border border-transparent hover:bg-blue-700 text-white px-3 py-2 rounded-xl text-xs font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-sm">
                <i class="fas fa-shopping-cart group-hover:rotate-12 transition-transform duration-300"></i>
                <span class="hidden sm:inline">Panier</span>
                @php $cartCount = collect(session('cart', []))->sum('quantity') @endphp
                @if($cartCount > 0)
                    <span class="bg-white text-blue-600 text-[10px] font-black px-1.5 py-0.5 rounded-md animate-bounce smooth-transition shadow-sm">{{ $cartCount }}</span>
                @endif
            </a>

            @if(auth()->check())
                <a href="/profile"
                    title="Mon Profil ({{ auth()->user()->points }} pts)"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 hover:text-slate-900 hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-0.5 relative group/avatar">
                    <i class="fas fa-user-circle text-base"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 rounded-full bg-emerald-500 border border-white"></span>
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 bg-slate-100 border border-slate-200 hover:border-blue-500/30 text-slate-700 hover:text-slate-900 px-3 py-2 rounded-xl text-xs font-bold transition-all duration-300 hover:-translate-y-0.5 shadow-sm">
                    <i class="fas fa-sign-in-alt text-blue-600 text-[11px]"></i>
                    <span>Se connecter</span>
                </a>
            @endif
        </div>
    </nav>

    <div class="max-w-7xl mx-auto space-y-10 relative z-10">

        <header class="text-center space-y-3 pt-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-50 border border-blue-200/60 text-blue-600 text-[10px] font-black uppercase tracking-[0.2em] mx-auto shadow-sm">
                ⚡ ElectroPro Premium Catalog
            </div>
            <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tighter italic uppercase">
                My <span class="text-blue-600 not-italic inline-block hover:scale-105 transition-transform duration-300 cursor-default">Shop</span>
            </h1>
            <p class="text-slate-500 text-xs sm:text-sm max-w-md mx-auto font-medium">
                Explore next-gen hardware assets with active smart instant filtration interfaces.
            </p>
        </header>

        @if(session('success'))
            <div class="max-w-xl mx-auto bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-semibold text-center shadow-md">
                <i class="fas fa-circle-check text-emerald-500 mr-1.5"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-xl mx-auto bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl text-xs font-semibold text-center shadow-md">
                <i class="fas fa-circle-exclamation text-rose-500 mr-1.5"></i> {{ session('error') }}
            </div>
        @endif

        <div class="space-y-6">
            <div class="max-w-xl mx-auto relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur opacity-10 group-hover:opacity-20 transition duration-700"></div>
                <form method="GET" action="{{ route('products.index') }}" id="searchForm">
                    <div class="relative bg-white rounded-2xl flex items-center px-4 border border-slate-200 shadow-sm group-hover:border-blue-500/50 transition-colors duration-500">
                        <span class="mr-3 text-xs text-blue-600"><i class="fas fa-search"></i></span>
                        <input
                            id="searchInput"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher un composant informatique, marque..."
                            class="w-full py-3.5 bg-transparent border-none text-slate-800 text-xs focus:outline-none placeholder-slate-400 font-medium"
                        />
                    </div>
                </form>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-2.5 pt-1" id="categoryFilters">
                <a href="{{ route('products.index') }}" data-category="all"
                    class="category-btn px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all duration-300 border bg-white text-slate-600 border-slate-200 hover:border-blue-500/40 hover:text-blue-600 shadow-sm">
                    🕹️ Tous les produits
                </a>
                @foreach($categories as $categorie)
                <a href="{{ route('products.index', ['category' => strtolower($categorie->name), 'search' => request('search')]) }}"
                    data-category="{{ strtolower($categorie->name) }}"
                    class="category-btn px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all duration-300 border
                    {{ request('category') === strtolower($categorie->name)
                        ? 'bg-blue-600 text-white border-blue-600 shadow-md shadow-blue-600/10'
                        : 'bg-white text-slate-600 border-slate-200 hover:border-blue-500/40 hover:text-blue-600 shadow-sm' }}">
                    {{ $categorie->name }}
                </a>
                @endforeach
            </div>
        </div>

        <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($products as $product)
            <div class="product-card bg-white rounded-[2rem] p-5 flex flex-col justify-between group border border-slate-100 shadow-[0_10px_25px_rgba(148,163,184,0.05)] hover:border-blue-500/30 hover:shadow-[0_20px_40px_rgba(148,163,184,0.12)] transition-all duration-500 relative overflow-hidden cursor-pointer"
                data-name="{{ strtolower($product->name) }}"
                data-category="{{ strtolower($product->category->name ?? 'all') }}"
                onclick="openModal({{ $product->id }})"
            >
                <div class="absolute top-0 left-0 w-1/2 h-[1px] bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-0 group-hover:opacity-100 pointer-events-none animate-sweep"></div>
                <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-40 h-40 bg-blue-500/0 group-hover:bg-blue-500/5 rounded-full blur-[50px] pointer-events-none smooth-transition"></div>

                <div>
                    <div class="relative w-full aspect-square bg-slate-50 rounded-2xl border border-slate-100 overflow-hidden flex items-center justify-center p-6 mb-4 group-hover:border-blue-500/10 smooth-transition">
                        @if($product->images->count())
                            <img src="{{ asset('storage/'.$product->images->first()->image) }}"
                                 alt="{{ $product->name }}"
                                 class="object-contain w-full h-full transform group-hover:scale-105 smooth-transition animate-float">
                        @else
                            <span class="text-slate-400 text-xs font-semibold">Aucune Image</span>
                        @endif
                    </div>

                    <div class="space-y-2.5 relative z-10">
                        <div class="flex items-center justify-between">
                            <span class="bg-blue-50 text-blue-600 text-[9px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md border border-blue-100 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 smooth-transition">
                                {{ $product->category->name ?? 'Composant' }}
                            </span>
                            <div class="flex text-amber-400 text-[9px] gap-0.5">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>

                        <h2 class="text-base font-extrabold text-slate-900 tracking-tight uppercase group-hover:text-blue-600 transition-colors duration-300 truncate">
                            {{ $product->name }}
                        </h2>

                        <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed group-hover:text-slate-600 transition-colors duration-300">
                            {{ $product->description }}
                        </p>

                        <div class="h-[1px] w-full bg-slate-100 relative overflow-hidden my-2">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-500/20 to-transparent -translate-x-full group-hover:animate-sweep"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-[10px] font-bold uppercase tracking-wide bg-slate-50 p-2 rounded-xl border border-slate-100">
                            <span class="text-emerald-600 flex items-center gap-1">
                                <i class="fas fa-gift text-[9px]"></i> Gain: +{{ $product->reward_points }} pts
                            </span>
                            <span class="text-indigo-600 flex items-center gap-1 justify-end">
                                <i class="fas fa-coins text-[9px]"></i> Coût: {{ $product->cost_points }} pts
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 space-y-3 pt-2 border-t border-slate-100 relative z-10" onclick="event.stopPropagation()">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-slate-400 text-[10px] uppercase font-bold tracking-wider">Prix Standard</span>
                            <span class="text-slate-900 font-black text-base tracking-tight group-hover:text-blue-600 smooth-transition">{{ number_format($product->price, 2) }} DH</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] font-bold {{ $product->stock > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $product->stock > 0 ? 'bg-emerald-500 animate-ping' : 'bg-rose-500' }}"></span>
                            <span>{{ $product->stock > 0 ? 'En Stock (' . $product->stock . ')' : 'Rupture' }}</span>
                        </div>
                    </div>

                    @if($product->stock > 0)
                        <div class="space-y-2">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-12 bg-slate-50 text-slate-800 text-center rounded-xl py-2 text-xs font-bold border border-slate-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/10">
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-slate-900 text-white font-bold py-2 rounded-xl text-xs transition-all flex items-center justify-center gap-1 shadow-sm">
                                    <i class="fas fa-basket-shopping text-[10px]"></i> Ajouter au Panier
                                </button>
                            </form>

                            <form action="{{ route('product.buy.points', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    @if(!auth()->check() || auth()->user()->points < $product->cost_points) disabled @endif
                                    class="w-full font-bold py-2 rounded-xl text-xs transition-all flex items-center justify-center gap-1 border
                                    {{ !auth()->check() || auth()->user()->points < $product->cost_points
                                        ? 'bg-slate-100 border-slate-200 text-slate-400 cursor-not-allowed'
                                        : 'bg-indigo-50 border border-indigo-100 hover:bg-indigo-600 text-indigo-600 hover:text-white hover:border-transparent' }}">
                                    <i class="fas fa-crown text-[10px]"></i> Échanger avec des Points
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-rose-50 border border-rose-100 text-rose-600 text-center py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider">
                            <i class="fas fa-circle-ban mr-1"></i> Épuisé temporairement
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16 bg-white border border-slate-100 rounded-3xl shadow-sm">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Le catalogue de produits est vide</h2>
            </div>
            @endforelse
        </div>

        <div id="noProducts" class="hidden text-center py-16 bg-white border border-slate-100 rounded-[2rem] max-w-md mx-auto shadow-sm">
            <div class="text-3xl mb-3">🛸</div>
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide">Aucun résultat trouvé</h3>
            <p class="text-slate-500 text-[11px] max-w-xs mx-auto mt-1">
                Aucun composant informatique ne correspond à vos critères de recherche actuels.
            </p>
        </div>

    </div>

    <div class="flex justify-center mt-12 mb-4">
        {{ $products->links() }}
    </div>

    <div id="modal" class="hidden fixed inset-0 bg-slate-900/40 z-50 flex items-center justify-center p-4 backdrop-blur-md transition-all duration-300">
        <div class="bg-white w-full max-w-5xl rounded-[2.5rem] p-6 sm:p-8 relative border border-slate-100 shadow-2xl overflow-y-auto max-h-[90vh]">
            <button onclick="closeModal()" class="absolute top-5 right-5 text-slate-400 hover:text-slate-800 text-base bg-slate-100 hover:bg-slate-200 w-10 h-10 rounded-full flex items-center justify-center transition-all">
                ✕
            </button>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        const products = @json($products->items());

        function openModal(id) {
            const product = products.find(p => p.id == id);
            if (!product) return;

            let images = product.images || [];
            let mainImages = '';
            let thumbs = '';

            if (images.length) {
                images.forEach((img, i) => {
                    mainImages += `
                        <img src="/storage/${img.image}"
                             class="main-img ${i === 0 ? '' : 'hidden'} w-full h-80 object-contain bg-slate-50 rounded-2xl transition-all duration-500"
                             data-index="${i}">
                    `;
                    thumbs += `
                        <img src="/storage/${img.image}"
                             onclick="showImage(${i})"
                             class="thumb-img w-16 h-16 object-cover rounded-xl border cursor-pointer smooth-transition bg-slate-50 p-1 ${i === 0 ? 'border-blue-600' : 'border-slate-200 hover:border-blue-600'}">
                    `;
                });
            } else {
                mainImages = `<div class="text-slate-400 text-xs h-80 flex items-center justify-center font-semibold">Aucune image disponible</div>`;
            }

            document.getElementById('modalContent').innerHTML = `
                <div class="grid md:grid-cols-2 gap-8 pt-4">
                    <div>
                        <div class="bg-slate-50 border border-slate-100 rounded-3xl p-4 mb-4 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-40 h-40 bg-blue-500/5 rounded-full blur-[40px] pointer-events-none"></div>
                            ${mainImages}
                        </div>
                        <div class="flex gap-2 overflow-x-auto pb-2">
                            ${thumbs}
                        </div>
                    </div>

                    <div class="flex flex-col justify-between space-y-5">
                        <div class="space-y-4">
                            <span class="bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-md border border-blue-100">
                                Détails du Produit
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 uppercase tracking-tight pt-2">
                                ${product.name}
                            </h2>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-xl">
                                ${product.description ?? 'Aucune description fournie.'}
                            </p>
                        </div>

                        <div class="space-y-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="flex items-baseline gap-2">
                                <span class="text-slate-400 text-[10px] font-bold uppercase">Prix:</span>
                                <span class="text-blue-600 text-3xl font-black tracking-tight">
                                    ${Number(product.price).toFixed(2)} <span class="text-sm font-normal">DH</span>
                                </span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-200 text-[11px] font-bold uppercase">
                                <div class="bg-white p-2.5 rounded-xl border border-slate-100 text-center shadow-sm">
                                    <span class="text-slate-400 block text-[9px] mb-0.5">Stock</span>
                                    <span class="${product.stock > 0 ? 'text-emerald-600' : 'text-rose-600'}">${product.stock} u</span>
                                </div>
                                <div class="bg-white p-2.5 rounded-xl border border-slate-100 text-center shadow-sm">
                                    <span class="text-slate-400 block text-[9px] mb-0.5">Gain pts</span>
                                    <span class="text-emerald-600">+${product.reward_points}</span>
                                </div>
                                <div class="bg-white p-2.5 rounded-xl border border-slate-100 text-center shadow-sm">
                                    <span class="text-slate-400 block text-[9px] mb-0.5">Coût pts</span>
                                    <span class="text-indigo-600">${product.cost_points}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function showImage(index) {
            document.querySelectorAll('.main-img').forEach(img => img.classList.add('hidden'));
            document.querySelectorAll('.thumb-img').forEach(img => img.className = "thumb-img w-16 h-16 object-cover rounded-xl border cursor-pointer smooth-transition bg-slate-50 p-1 border-slate-200 hover:border-blue-600");
            
            const active = document.querySelector(`.main-img[data-index="${index}"]`);
            if (active) active.classList.remove('hidden');
            
            const thumbs = document.querySelectorAll('.thumb-img');
            if (thumbs[index]) thumbs[index].className = "thumb-img w-16 h-16 object-cover rounded-xl border cursor-pointer smooth-transition bg-slate-50 p-1 border-blue-600";
        }

        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Live Filtration
        const searchInput = document.getElementById('searchInput');
        const categoryButtons = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');
        const noProductsMessage = document.getElementById('noProducts');

        let currentCategory = '{{ request("category", "all") }}';
        let currentSearch = '{{ request("search", "") }}';

        function filterCatalog() {
            let visibleCount = 0;
            productCards.forEach(card => {
                const name = card.getAttribute('data-name').toLowerCase();
                const category = card.getAttribute('data-category').toLowerCase();
                const matchesSearch = name.includes(currentSearch.toLowerCase());
                const matchesCategory = currentCategory === 'all' || category === currentCategory;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            noProductsMessage.classList.toggle('hidden', visibleCount > 0);
        }

        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value;
            filterCatalog();
        });

        categoryButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const targetCat = btn.getAttribute('data-category');
                if (!targetCat) return;

                e.preventDefault();
                categoryButtons.forEach(b => {
                    b.className = "category-btn px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all duration-300 border bg-white text-slate-600 border-slate-200 hover:border-blue-500/40 hover:text-blue-600 shadow-sm";
                });
                btn.className = "category-btn px-4 py-2 rounded-xl text-[11px] font-bold uppercase tracking-wider transition-all duration-300 border bg-blue-600 text-white border-blue-600 shadow-md shadow-blue-600/10";

                currentCategory = targetCat.toLowerCase();
                filterCatalog();
            });
        });
    </script>
</body>
</html>