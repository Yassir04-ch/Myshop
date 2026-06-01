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
        
        <header class="text-center space-y-3">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-black uppercase tracking-[0.25em] mx-auto shadow-sm">
                ⚡ MyShop
            </div>
            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tighter italic uppercase">
                Fadwa <span class="text-blue-500 not-italic">Store</span>
            </h1>
            <p class="text-slate-500 text-sm max-w-md mx-auto">
                Explore next-gen static computing hardware assets with instant high precision filtration modules.
            </p>
        </header>

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
                    🕹️ All Catalog
                </button>
                <button
                    data-category="audio"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white"
                >
                    🎧 Premium Audio
                </button>
                <button
                    data-category="gaming"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white"
                >
                    🎮 Gaming Gear
                </button>
                <button
                    data-category="components"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white"
                >
                    ⚡ Components
                </button>
                <button
                    data-category="screens"
                    class="category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white"
                >
                    🖥️ Displays
                </button>
            </div>
        </div>

        <div id="productsGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 transition-all duration-500" data-name="SONY WH-1000XM5" data-category="audio">
                <div class="relative w-full aspect-square bg-[#020617] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=400" alt="Sony XM5" class="max-w-full max-h-full object-contain rounded-2xl transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-600/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10">Premium Audio</span>
                        <div class="flex text-yellow-500 text-[9px]"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">SONY WH-1000XM5</h2>
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed">The world's best noise cancelling headphones just got better. Pure silence. Pure sound.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-white font-black text-xl tracking-tight">3,499 <span class="text-xs text-blue-400">DH</span></span>
                            <span class="text-[10px] text-slate-500 line-through">4,200 DH</span>
                        </div>
                        <button class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider">🛒 Buy Now</button>
                    </div>
                </div>
            </div>

            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 transition-all duration-500" data-name="Apex Pro TKL Mechanical Keyboard" data-category="gaming">
                <div class="relative w-full aspect-square bg-[#020617] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6">
                    <img src="https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?auto=format&fit=crop&q=80&w=400" alt="Keyboard" class="max-w-full max-h-full object-contain rounded-2xl transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-600/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10">Gaming Gear</span>
                        <div class="flex text-yellow-500 text-[9px]"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">Apex Pro TKL</h2>
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed">OmniPoint 2.0 adjustable switches provide 11x quicker response and 2x durability.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-white font-black text-xl tracking-tight">2,199 <span class="text-xs text-blue-400">DH</span></span>
                            <span class="text-[10px] text-slate-500 line-through">2,600 DH</span>
                        </div>
                        <button class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider">🛒 Buy Now</button>
                    </div>
                </div>
            </div>

            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 transition-all duration-500" data-name="ASUS ROG Swift 32 OLED Monitor" data-category="screens">
                <div class="relative w-full aspect-square bg-[#020617] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6">
                    <img src="https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?auto=format&fit=crop&q=80&w=400" alt="Monitor" class="max-w-full max-h-full object-contain rounded-2xl transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-600/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10">Displays</span>
                        <div class="flex text-yellow-500 text-[9px]"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">ASUS ROG Swift 32"</h2>
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed">Quantum Dot OLED panel delivers unrivaled 240Hz speed and deepest cinematic blacks.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-white font-black text-xl tracking-tight">12,499 <span class="text-xs text-blue-400">DH</span></span>
                            <span class="text-[10px] text-slate-500 line-through">14,500 DH</span>
                        </div>
                        <button class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider">🛒 Buy Now</button>
                    </div>
                </div>
            </div>

            <div class="product-card glass-card rounded-[2.5rem] p-6 flex flex-col justify-between group hover:border-blue-500/30 transition-all duration-500" data-name="NVIDIA RTX 4090 Founders Edition" data-category="components">
                <div class="relative w-full aspect-square bg-[#020617] rounded-[2rem] border border-white/5 overflow-hidden flex items-center justify-center p-6 mb-6">
                    <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=400" alt="RTX 4090" class="max-w-full max-h-full object-contain rounded-2xl transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="bg-blue-600/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full border border-blue-500/10">Components</span>
                        <div class="flex text-yellow-500 text-[9px]"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                    <h2 class="text-xl font-black text-white tracking-tight leading-tight uppercase group-hover:text-blue-400 transition-colors duration-300">NVIDIA RTX 4090 FE</h2>
                    <p class="text-slate-500 text-xs line-clamp-2 italic leading-relaxed">The ultimate GeForce GPU. Powered by ultra-efficient Ada Lovelace architecture and 24GB G6X.</p>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="flex flex-col">
                            <span class="text-white font-black text-xl tracking-tight">24,999 <span class="text-xs text-blue-400">DH</span></span>
                        </div>
                        <button class="bg-blue-600 hover:bg-white hover:text-black text-white font-black px-4 py-2.5 rounded-xl transition-all duration-300 text-xs uppercase tracking-wider">🛒 Buy Now</button>
                    </div>
                </div>
            </div>

        </div>

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

        // Function bach t-filtrer dynamic f l-blasa
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

            // Ila mal9a walo, n-bayno l-message dyal empty catalog
            if (visibleCount === 0) {
                noProductsMessage.classList.remove('hidden');
            } else {
                noProductsMessage.classList.add('hidden');
            }
        }

        // Event listener d l-kwayri dyal search
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase();
            filterCatalog();
        });

        // Event listener dyal les classes buttons
        categoryButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active background styles from all buttons
                categoryButtons.forEach(b => {
                    b.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-slate-900/40 text-slate-400 border-white/5 hover:border-blue-500/30 hover:text-white";
                });

                // Add active styles to clicked button
                btn.className = "category-btn px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-300 border bg-blue-600 text-white border-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.3)]";

                currentCategory = btn.getAttribute('data-category');
                filterCatalog();
            });
        });
    </script>
</body>
</html>