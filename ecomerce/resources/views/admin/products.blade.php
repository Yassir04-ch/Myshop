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
                        <a href="{{route('dashboard')}}" class="text-slate-400 hover:text-slate-900 transition-colors">Overview</a>
                        <a href="" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Products</a>
                        <a href="{{route('orders')}}" class="text-slate-400 hover:text-slate-900 transition-colors">Orders</a>
                        <a href="{{route('clients')}}" class="text-slate-400 hover:text-slate-900 transition-colors">Clients</a>
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
                    
                         <a href="/profile" 
                        title="Mon Profil ({{ auth()->user()->points }} pts)"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-slate-900/60 border border-white/5 text-slate-400 hover:text-white hover:border-blue-500/30 transition-all duration-300 hover:-translate-y-0.5 relative group/avatar">
                            <i class="fas fa-user-circle text-base"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 rounded-full bg-emerald-500 border border-slate-900"></span>
                        </a>
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
                            
                            @forelse($products as $product)
                                <tr class="hover:bg-slate-50/40 transition-colors group">
                                    <td class="p-4 pl-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-2xl border border-slate-100 bg-slate-50 p-1 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                                @if($product->images->count() > 0)
                                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                        alt="{{ $product->name }}"
                                                        class="max-w-full max-h-full object-contain rounded-lg transition-transform group-hover:scale-110">
                                                @else
                                                    <span class="text-2xl">📦</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="font-bold text-slate-800 block leading-tight group-hover:text-indigo-600 transition-colors">
                                                    {{ $product->name }}
                                                </span>
                                                <span class="text-[11px] text-slate-400 block mt-0.5 italic line-clamp-1">
                                                    {{ $product->description ?? '—' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 font-mono text-xs text-slate-400">#EPR-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full border border-indigo-100/30">
                                            {{ $product->category->name ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="p-4 font-black text-slate-800">
                                        {{ number_format($product->price, 2) }} <span class="text-xs text-slate-400 font-semibold">DH</span>
                                    </td>
                                    <td class="p-4">
                                        @if($product->stock === 0)
                                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-500">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Out of Stock
                                            </span>
                                        @elseif($product->stock <= 5)
                                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Low Stock ({{ $product->stock }})
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> In Stock ({{ $product->stock }})
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 pr-8 text-right space-x-1 whitespace-nowrap">
                                        <a href="{{ route('products.edit', $product) }}"
                                        class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all text-xs">
                                            ✏️
                                        </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('Supprimer {{ $product->name }} ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-slate-50 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all text-xs">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center text-slate-400 text-sm">Aucun produit trouvé.</td>
                                </tr>
                                @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </main>

</body>
</html>