<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Update Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; }
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
                        <a href="{{ route('products.index') }}" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Products</a>
                        <a href="/orders" class="text-slate-400 hover:text-slate-900 transition-colors">Orders</a>
                        <a href="/clients" class="text-slate-400 hover:text-slate-900 transition-colors">Users</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                        ⬅️ Back to Inventory
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="border-b border-slate-200/60 pb-6">
                <h1 class="font-black text-3xl text-slate-900 tracking-tight uppercase">
                    Update Product
                </h1>
                <p class="text-slate-400 text-xs mt-0.5">
                    Modify the product profile — changes are applied directly to the active database ledger.
                </p>
            </div>

            {{-- Flash success --}}
            @if(session('success'))
            <div class="flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.01)] border border-slate-100 p-8 sm:p-10">

                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div class="sm:col-span-2 space-y-2">
                            <label for="name" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Product Name / Title
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                placeholder="e.g., SONY WH-1000XM5 Wireless Headphones"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50"
                                required
                            />
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label for="category_id" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Category Division
                            </label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('category_id') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold bg-slate-50/50 appearance-none cursor-pointer"
                                required
                            >
                                <option value="" disabled>Select partition...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price --}}
                        <div class="space-y-2">
                            <label for="price" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Current Price (DH)
                            </label>
                            <div class="relative flex items-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    placeholder="3499.00"
                                    class="w-full px-4 py-3 pr-12 rounded-xl border {{ $errors->has('price') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-bold transition-colors bg-slate-50/50"
                                    required
                                />
                                <span class="absolute right-4 text-xs font-bold text-slate-400">DH</span>
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="space-y-2">
                            <label for="stock" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Stock Counter
                            </label>
                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock', $product->stock) }}"
                                placeholder="50"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('stock') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50"
                                required
                            />
                        </div>

                        {{-- Image --}}
                        <div class="sm:col-span-2 space-y-2">
                            <label class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Product Visual Media
                            </label>

                            @if($product->image)
                            <div class="flex items-center gap-4 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-16 h-16 rounded-xl object-cover border border-slate-200 shrink-0">
                                <div>
                                    <p class="text-xs font-bold text-slate-700">Image actuelle</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Upload une nouvelle image pour la remplacer</p>
                                </div>
                            </div>
                            @endif

                            <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center bg-slate-50/50 hover:bg-slate-50 transition-colors relative group">
                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    accept="image/jpg,image/jpeg,image/png,image/webp"
                                    class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10"
                                />
                                <div class="space-y-2 pointer-events-none">
                                    <span class="text-2xl block group-hover:scale-110 transition-transform">🖼️</span>
                                    <p class="text-xs font-bold text-slate-700">Click to upload new image</p>
                                    <p class="text-[10px] text-slate-400">PNG, JPG or WEBP — max 2MB</p>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="sm:col-span-2 space-y-2">
                            <label for="description" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Catalog Description / Specifications
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Describe features, hardware specs, warranty info..."
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('description') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50 resize-none"
                            >{{ old('description', $product->description) }}</textarea>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <a href="{{ route('products.index') }}"
                            class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-slate-400 hover:bg-slate-50 transition-colors">
                            Annuler
                        </a>
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md shadow-indigo-100 active:scale-95">
                            🚀 Update Product
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </main>

</body>
</html>