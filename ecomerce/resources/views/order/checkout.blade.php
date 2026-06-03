<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Checkout — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #020617; }</style>
</head>
<body class="text-slate-300 antialiased font-sans p-6 sm:p-12">

<div class="max-w-2xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-black text-white uppercase italic">✅ Valider la commande</h1>
        <a href="{{ route('cart.index') }}"
            class="text-xs text-slate-400 hover:text-white border border-white/10 px-4 py-2 rounded-xl transition">
            ← Retour au panier
        </a>
    </div>

    <!-- ERROR -->
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- ORDER SUMMARY -->
    <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-5 space-y-3">
        <p class="text-xs text-slate-400 uppercase tracking-wider mb-4">Récapitulatif</p>

        @foreach($items as $item)
        <div class="flex justify-between text-sm">
            <span class="text-slate-300">{{ $item['name'] }} <span class="text-slate-500">× {{ $item['quantity'] }}</span></span>
            <span class="text-blue-400 font-black">{{ number_format($item['price'] * $item['quantity'], 2) }} DH</span>
        </div>
        @endforeach

        <div class="border-t border-white/5 pt-3 flex justify-between">
            <span class="text-slate-400 text-sm">Total</span>
            <span class="text-xl font-black text-white">{{ number_format($total, 2) }} DH</span>
        </div>
    </div>

    <!-- FORM -->
    <form action="{{ route('order.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- USER INFO (readonly) -->
        <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-5 space-y-2">
            <p class="text-xs text-slate-400 uppercase tracking-wider mb-3">Vos informations</p>
            <div class="flex items-center gap-3 text-sm text-slate-300">
                <span class="text-blue-400">👤</span>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center gap-3 text-sm text-slate-300">
                <span class="text-blue-400">✉️</span>
                <span>{{ auth()->user()->email }}</span>
            </div>
            @if(auth()->user()->phone)
            <div class="flex items-center gap-3 text-sm text-slate-300">
                <span class="text-blue-400">📞</span>
                <span>{{ auth()->user()->phone }}</span>
            </div>
            @endif
        </div>

        <!-- DELIVERY INFO -->
        <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-5 space-y-4">
            <p class="text-xs text-slate-400 uppercase tracking-wider">Adresse de livraison</p>

            <div>
                <label class="text-xs text-slate-400 mb-1 block">Adresse</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    class="w-full bg-slate-800 text-white rounded-xl px-4 py-2.5 text-sm border border-white/10 focus:outline-none focus:border-blue-500/50"
                    placeholder="N° rue, quartier...">
                @error('address') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-slate-400 mb-1 block">Ville</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full bg-slate-800 text-white rounded-xl px-4 py-2.5 text-sm border border-white/10 focus:outline-none focus:border-blue-500/50"
                        placeholder="Casablanca">
                    @error('city') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-xs text-slate-400 mb-1 block">Code postal</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                        class="w-full bg-slate-800 text-white rounded-xl px-4 py-2.5 text-sm border border-white/10 focus:outline-none focus:border-blue-500/50"
                        placeholder="20000">
                    @error('postal_code') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- PAYMENT METHOD -->
        <div class="space-y-3">
            <p class="text-xs text-slate-400 uppercase tracking-wider">Mode de paiement</p>

            <label class="flex items-center gap-4 bg-[#0f172a]/60 border border-white/5 hover:border-blue-500/30 rounded-2xl p-4 cursor-pointer transition">
                <input type="radio" name="payment_method" value="cart" class="accent-blue-500">
                <div>
                    <p class="font-black text-white text-sm">💳 Payer par carte</p>
                    <p class="text-xs text-slate-500 mt-0.5">Paiement immédiat en ligne</p>
                </div>
            </label>

            <label class="flex items-center gap-4 bg-[#0f172a]/60 border border-white/5 hover:border-blue-500/30 rounded-2xl p-4 cursor-pointer transition">
                <input type="radio" name="payment_method" value="livraison" class="accent-blue-500">
                <div>
                    <p class="font-black text-white text-sm">🚚 Payer à la livraison</p>
                    <p class="text-xs text-slate-500 mt-0.5">Vous payez quand vous recevez la commande</p>
                </div>
            </label>

            @error('payment_method')
                <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl uppercase tracking-wider transition">
            Confirmer la commande 🎉
        </button>

    </form>

</div>
</body>
</html>