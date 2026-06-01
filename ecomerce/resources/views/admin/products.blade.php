<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Products Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>
<body class="text-slate-600 antialiased font-sans bg-[#f8fafc]">

    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <div class="flex items-center gap-8">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">⚡</span>
                        <span class="font-black text-slate-900 tracking-tight uppercase italic text-lg">
                            ElectroPro <span class="text-indigo-600 not-italic">Admin</span>
                        </span>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-6 text-xs font-bold uppercase tracking-wider">
                        <a href="/dashboard" class="text-slate-400 hover:text-slate-900 transition-colors">Overview</a>
                        <a href="/products" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Products</a>
                        <a href="/orders" class="text-slate-400 hover:text-slate-900 transition-colors">Orders</a>
                        <a href="/users" class="text-slate-400 hover:text-slate-900 transition-colors">Users</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a 
                        href="{{route('products.create')}}" 
                        class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md shadow-indigo-100 active:scale-95"
                    >
                        <span>➕</span> Create Product
                    </a>
                    
                    <div class="w-px h-6 bg-slate-200"></div>
                    
                    <div class="flex items-center gap-2 cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-700 text-xs">
                            AD
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-slate-200/60 pb-6">
                <div>
                    <h1 class="font-black text-3xl text-slate-900 tracking-tight uppercase">
                        Products Inventory
                    </h1>
                    <p class="text-slate-400 text-xs mt-0.5">Control global stock listings, details adjustments, and database purging assets.</p>
                </div>
                <div class="inline-flex items-center gap-2 bg-white border border-slate-200/80 px-3 py-1.5 rounded-xl text-xs font-bold text-slate-500 self-start sm:self-auto shadow-sm">
                    📅 {{ date('F d, Y') }}
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)] flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">📦</div>
                    <div>
                        <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Active Stock</span>
                        <span class="text-xl font-black text-slate-800 block">1,240 Items</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)] flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-sm font-bold">🏷️</div>
                    <div>
                        <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Categories</span>
                        <span class="text-xl font-black text-slate-800 block">8 Sections</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)] flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">⚠️</div>
                    <div>
                        <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Low Stock Alert</span>
                        <span class="text-xl font-black text-slate-800 block text-amber-600">3 Products</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.01)] border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        
                        <thead>
                            <tr class="bg-slate-50/70 text-slate-400 text-[10px] font-black uppercase tracking-wider border-b border-slate-100">
                                <th class="p-4 pl-8">Product Details</th>
                                <th class="p-4">SKU / ID</th>
                                <th class="p-4">Category</th>
                                <th class="p-4">Current Price</th>
                                <th class="p-4">Stock Status</th>
                                <th class="p-4 pr-8 text-right">Actions Operations</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100/70 text-slate-600 font-medium">
                            
                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <td class="p-4 pl-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl border border-slate-100 bg-slate-50 p-1 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=80" alt="Item Thumbnail" class="max-w-full max-h-full object-contain rounded-lg transition-transform group-hover:scale-110">
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block leading-tight group-hover:text-indigo-600 transition-colors">SONY WH-1000XM5</span>
                                            <span class="text-[11px] text-slate-400 block mt-0.5 italic">Premium Silver Headset</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-xs text-slate-400">#EPR-9041</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100/30">Premium Audio</span>
                                </td>
                                <td class="p-4 font-black text-slate-800">3,499 <span class="text-xs text-slate-400 font-semibold">DH</span></td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> In Stock (42)
                                    </span>
                                </td>
                                <td class="p-4 pr-8 text-right space-x-1 whitespace-nowrap">
                                    <a href="/products/1/edit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all text-xs" title="Edit Item">
                                        ✏️
                                    </a>
                                    <form action="/products/1" method="POST" class="inline-block" onsubmit="return confirm('Are you absolutely sure you want to delete this product listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all text-xs" title="Delete Item">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <td class="p-4 pl-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl border border-slate-100 bg-slate-50 p-1 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                            <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=80" alt="Item Thumbnail" class="max-w-full max-h-full object-contain rounded-lg transition-transform group-hover:scale-110">
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block leading-tight group-hover:text-indigo-600 transition-colors">NVIDIA RTX 4090 FE</span>
                                            <span class="text-[11px] text-slate-400 block mt-0.5 italic">Founders Edition 24GB GDDR6X</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-xs text-slate-400">#EPR-1029</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full border border-indigo-100/30">Components</span>
                                </td>
                                <td class="p-4 font-black text-slate-800">24,999 <span class="text-xs text-slate-400 font-semibold">DH</span></td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Low Stock (2)
                                    </span>
                                </td>
                                <td class="p-4 pr-8 text-right space-x-1 whitespace-nowrap">
                                    <a href="/products/2/edit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all text-xs">✏️</a>
                                    <form action="/products/2" method="POST" class="inline-block" onsubmit="return confirm('Purge this asset?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all text-xs">🗑️</button>
                                    </form>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/40 transition-colors group">
                                <td class="p-4 pl-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl border border-slate-100 bg-slate-50 p-1 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                            <img src="https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?auto=format&fit=crop&q=80&w=80" alt="Item Thumbnail" class="max-w-full max-h-full object-contain rounded-lg transition-transform group-hover:scale-110">
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block leading-tight group-hover:text-indigo-600 transition-colors">Logitech G Pro X 2</span>
                                            <span class="text-[11px] text-slate-400 block mt-0.5 italic">Wireless Esports Gaming Mouse</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 font-mono text-xs text-slate-400">#EPR-3382</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 bg-purple-50 text-purple-700 text-xs font-semibold rounded-full border border-purple-100/30">Gaming Gear</span>
                                </td>
                                <td class="p-4 font-black text-slate-800">1,599 <span class="text-xs text-slate-400 font-semibold">DH</span></td>
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> In Stock (89)
                                    </span>
                                </td>
                                <td class="p-4 pr-8 text-right space-x-1 whitespace-nowrap">
                                    <a href="/products/3/edit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all text-xs">✏️</a>
                                    <form action="/products/3" method="POST" class="inline-block" onsubmit="return confirm('Purge this asset?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all text-xs">🗑️</button>
                                    </form>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-xs font-semibold text-slate-400">
                    <span>Showing 3 active hardware listings</span>
                    <div class="flex items-center gap-1">
                        <button class="px-3 py-1.5 bg-white border border-slate-200 text-slate-600 rounded-lg shadow-sm opacity-50 cursor-not-allowed">Previous</button>
                        <button class="px-3 py-1.5 bg-white border border-slate-200 text-slate-600 rounded-lg shadow-sm hover:bg-slate-50">Next</button>
                    </div>
                </div>

            </div>

        </div>
    </main>

</body>
</html>