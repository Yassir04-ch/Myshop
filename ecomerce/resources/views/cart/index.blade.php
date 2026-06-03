<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #020617; }</style>
</head>
<body class="text-slate-300 antialiased font-sans p-6 sm:p-12">

<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-black text-white uppercase italic">🛒 Mon Panier</h1>
        <a href="{{ route('products.index') }}"
            class="text-xs text-slate-400 hover:text-white border border-white/10 px-4 py-2 rounded-xl transition">
            ← Continuer les achats
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($items))
        <div class="text-center py-24 bg-[#0f172a]/40 border border-white/5 rounded-3xl">
            <div class="text-5xl mb-4">🛸</div>
            <p class="text-slate-500 text-sm">Votre panier est vide</p>
            <a href="{{ route('products.index') }}"
                class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-black px-6 py-3 rounded-2xl text-xs uppercase tracking-wider transition">
                Voir les produits →
            </a>
        </div>

    @else

        <div class="space-y-4">
            @foreach($items as $id => $item)
            <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-5 flex items-center justify-between gap-4">

                <div class="flex-1">
                    <p class="font-black text-white uppercase text-sm">{{ $item['name'] }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ number_format($item['price'], 2) }} DH / unité</p>
                </div>

                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                    @csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                        class="w-16 bg-slate-800 text-white text-center rounded-xl py-2 text-sm border border-white/10 focus:outline-none">
                    <button class="text-xs bg-slate-700 hover:bg-slate-600 text-white px-3 py-2 rounded-xl transition">↻</button>
                </form>

                <p class="text-blue-400 font-black text-sm w-24 text-right">
                    {{ number_format($item['price'] * $item['quantity'], 2) }} DH
                </p>

                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-400 hover:text-red-300 text-lg transition">✕</button>
                </form>

            </div>
            @endforeach
        </div>

        <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-5 flex justify-between items-center">
            <span class="text-slate-400 text-sm uppercase tracking-wider">Total</span>
            <span class="text-2xl font-black text-white">{{ number_format($total, 2) }} DH</span>
        </div>

        <a href="{{ route('order.checkout') }}"
            class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl uppercase tracking-wider transition">
            Passer la commande →
        </a>

    @endif

</div>
</body>
</html>