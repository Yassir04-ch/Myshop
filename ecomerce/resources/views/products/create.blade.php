<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Create New Product</title>
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
                        <a href="/products" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Products</a>
                        <a href="/orders" class="text-slate-400 hover:text-slate-900 transition-colors">Orders</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a
                        href="/products"
                        class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all"
                    >
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
                    Add New Product Asset
                </h1>
                <p class="text-slate-400 text-xs mt-0.5">Deploy a new hardware component profile directly inside the active global database ledger.</p>
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

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Name --}}
                        <div class="sm:col-span-2 space-y-2">
                            <label for="name" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">Product Name / Title</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g., SONY WH-1000XM5 Wireless Headphones"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50"
                                required
                            />
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label for="category_id" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">Category Division</label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('category_id') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50 appearance-none cursor-pointer"
                                required
                            >
                                <option value="" disabled selected>Select partition...</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('category_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="space-y-2">
                            <label for="price" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">Current Price (DH)</label>
                            <div class="relative flex items-center">
                                <input
                                    type="number"
                                    step="0.01"
                                    id="price"
                                    name="price"
                                    value="{{ old('price') }}"
                                    placeholder="3499.00"
                                    class="w-full px-4 py-3 pr-12 rounded-xl border {{ $errors->has('price') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-bold transition-colors bg-slate-50/50"
                                    required
                                />
                                <span class="absolute right-4 text-xs font-bold text-slate-400">DH</span>
                            </div>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Reward Points --}}
                        <div class="space-y-2">
                            <label for="reward_points" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Reward Points (Récompense)
                            </label>
                            <div class="relative flex items-center">
                                <input
                                    type="number"
                                    id="reward_points"
                                    name="reward_points"
                                    value="{{ old('reward_points') }}"
                                    placeholder="10"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-bold transition-colors bg-slate-50/50"
                                    required
                                />
                                <span class="absolute right-4 text-xs font-bold text-slate-400">🎁 pts</span>
                            </div>
                            @error('reward_points')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Cost Points --}}
                        <div class="space-y-2">
                            <label for="cost_points" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Cost Points (Prix du produit)
                            </label>
                            <div class="relative flex items-center">
                                <input
                                    type="number"
                                    id="cost_points"
                                    name="cost_points"
                                    value="{{ old('cost_points') }}"
                                    placeholder="100"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-bold transition-colors bg-slate-50/50"
                                    required
                                />
                                <span class="absolute right-4 text-xs font-bold text-slate-400">🪙 pts</span>
                            </div>
                            @error('cost_points')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="space-y-2">
                            <label for="stock" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">Initial Stock Counter</label>
                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                value="{{ old('stock') }}"
                                placeholder="50"
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('stock') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50"
                                required
                            />
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Images --}}
                        <div class="sm:col-span-2 space-y-2">
                            <label class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">
                                Product Visual Media
                            </label>

                            {{-- Preview container -- tatban qbel upload zone --}}
                            <div id="previewContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4 w-full"></div>
                            {{-- Upload zone -- input hidden w zone clickable --}}
                            <div
                                class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center bg-slate-50/50 hover:bg-slate-50 transition-colors relative group cursor-pointer"
                                onclick="document.getElementById('images').click()"
                            >
                               <input
                                type="file"
                                id="images"
                                name="images[]"
                                multiple="multiple"
                                accept="image/*"
                                class="hidden"
                            >

                                <div class="space-y-2 pointer-events-none">
                                    <span class="text-2xl block group-hover:scale-110 transition-transform">🖼️</span>
                                    <p class="text-xs font-bold text-slate-700">Click to upload catalog image asset</p>
                                    <p class="text-[10px] text-slate-400">Supports PNG, JPG or WEBP up to 2MB</p>
                                </div>
                            </div>

                            @error('images')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="sm:col-span-2 space-y-2">
                            <label for="description" class="text-[11px] font-black uppercase tracking-wider text-slate-400 block">Catalog Description / Specifications</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Describe features, hardware compatibility matrix configurations, warranties info..."
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('description') ? 'border-red-400' : 'border-slate-200' }} focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-sm font-semibold transition-colors bg-slate-50/50 resize-none"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <button
                            type="reset"
                            id="resetBtn"
                            class="px-5 py-3 rounded-xl text-xs font-bold uppercase tracking-wider text-slate-400 hover:bg-slate-50 transition-colors"
                        >
                            Reset Form
                        </button>
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-md shadow-indigo-100 active:scale-95"
                        >
                            🚀 Deploy New Product
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </main>
<script>
const imageInput = document.getElementById('images');
const previewContainer = document.getElementById('previewContainer');
const resetBtn = document.getElementById('resetBtn');

let selectedFiles = [];

imageInput.addEventListener('change', function () {

    const newFiles = Array.from(this.files);

    // zidhom ma3a li kaynin
    selectedFiles = [...selectedFiles, ...newFiles];

    previewContainer.innerHTML = "";

    selectedFiles.forEach((file, i) => {

        const imageURL = URL.createObjectURL(file);

        const box = document.createElement("div");

        box.className = "relative";

        box.innerHTML = `
            <img 
                src="${imageURL}"
                class="w-full h-32 object-cover rounded-xl border border-slate-200"
            >

            <button 
                type="button"
                onclick="removeImage(${i})"
                class="absolute top-2 left-2 bg-red-500 text-white rounded px-2 text-xs"
            >
                X
            </button>

            <span class="absolute top-2 right-2 bg-black text-white px-2 py-1 rounded text-xs">
                ${i + 1}
            </span>
        `;

        previewContainer.appendChild(box);
    });

    // update input files
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    imageInput.files = dataTransfer.files;
});

function removeImage(index) {

    selectedFiles.splice(index, 1);

    const dataTransfer = new DataTransfer();

    selectedFiles.forEach(file => {
        dataTransfer.items.add(file);
    });

    imageInput.files = dataTransfer.files;

    previewContainer.innerHTML = "";

    selectedFiles.forEach((file, i) => {

        const imageURL = URL.createObjectURL(file);

        const box = document.createElement("div");

        box.className = "relative";

        box.innerHTML = `
            <img 
                src="${imageURL}"
                class="w-full h-32 object-cover rounded-xl border border-slate-200"
            >

            <button 
                type="button"
                onclick="removeImage(${i})"
                class="absolute top-2 left-2 bg-red-500 text-white rounded px-2 text-xs"
            >
                X
            </button>

            <span class="absolute top-2 right-2 bg-black text-white px-2 py-1 rounded text-xs">
                ${i + 1}
            </span>
        `;

        previewContainer.appendChild(box);
    });
}

resetBtn.addEventListener("click", () => {
    selectedFiles = [];
    previewContainer.innerHTML = "";
    imageInput.value = "";
});
</script>
</body>
</html>