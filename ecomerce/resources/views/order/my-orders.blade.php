<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes commandes — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #020617; }</style>
</head>
<body class="text-slate-300 antialiased font-sans p-6 sm:p-12">

<div class="max-w-4xl mx-auto space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-black text-white uppercase italic">📦 Mes Commandes</h1>
        <a href="{{ route('products.index') }}"
            class="text-xs text-slate-400 hover:text-white border border-white/10 px-4 py-2 rounded-xl transition">
            ← Continuer les achats
        </a>
    </div>

    <!-- EMPTY -->
    @if($orders->isEmpty())
        <div class="text-center py-24 bg-[#0f172a]/40 border border-white/5 rounded-3xl">
            <div class="text-5xl mb-4">🛸</div>
            <p class="text-slate-500 text-sm">Vous n'avez pas encore de commandes</p>
            <a href="{{ route('products.index') }}"
                class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white font-black px-6 py-3 rounded-2xl text-xs uppercase tracking-wider transition">
                Voir les produits →
            </a>
        </div>

    @else

        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-[#0f172a]/60 border border-white/5 rounded-2xl p-6 space-y-4">

                <!-- ORDER HEADER -->
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500">Commande #{{ $order->id }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <!-- STATUS BADGE -->
                    <span class="px-3 py-1 rounded-full text-xs font-black uppercase
                        @if($order->status === 'pending')    bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                        @elseif($order->status === 'processing') bg-blue-500/10 text-blue-400 border border-blue-500/20
                        @elseif($order->status === 'shipped')    bg-indigo-500/10 text-indigo-400 border border-indigo-500/20
                        @elseif($order->status === 'delivered')  bg-green-500/10 text-green-400 border border-green-500/20
                        @elseif($order->status === 'cancelled')  bg-red-500/10 text-red-400 border border-red-500/20
                        @endif">
                        @if($order->status === 'pending')     ⏳ En attente
                        @elseif($order->status === 'processing') 🔄 En traitement
                        @elseif($order->status === 'shipped')    🚚 Expédié
                        @elseif($order->status === 'delivered')  ✅ Livré
                        @elseif($order->status === 'cancelled')  ❌ Annulé
                        @endif
                    </span>
                </div>

                <!-- PROGRESS BAR -->
                @php
                    $steps = ['pending', 'processing', 'shipped', 'delivered'];
                    $currentStep = array_search($order->status, $steps);
                @endphp
                @if($order->status !== 'cancelled')
                <div class="flex items-center gap-2">
                    @foreach(['⏳ Reçue', '🔄 Traitement', '🚚 Expédié', '✅ Livré'] as $i => $label)
                    <div class="flex-1 text-center">
                        <div class="h-1.5 rounded-full {{ $i <= $currentStep ? 'bg-blue-500' : 'bg-slate-700' }} mb-1"></div>
                        <p class="text-[9px] {{ $i <= $currentStep ? 'text-blue-400' : 'text-slate-600' }} uppercase font-black">
                            {{ $label }}
                        </p>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- ITEMS -->
                <div class="space-y-2 border-t border-white/5 pt-4">
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-300">
                            {{ $item->product->name }}
                            <span class="text-slate-500">× {{ $item->quantity }}</span>
                        </span>
                        <span class="text-blue-400 font-black">
                            {{ number_format($item->price * $item->quantity, 2) }} DH
                        </span>
                    </div>
                    @endforeach
                </div>

                <!-- FOOTER -->
                <div class="flex items-center justify-between border-t border-white/5 pt-4">

                    <!-- DELIVERY ADDRESS -->
                    <div class="text-xs text-slate-500">
                        📍 {{ $order->address }}, {{ $order->city }} {{ $order->postal_code }}
                    </div>

                    <!-- TOTAL + PAYMENT -->
                    <div class="text-right">
                        <p class="text-white font-black">{{ number_format($order->total_amount, 2) }} DH</p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            {{ $order->payment_method === 'cart' ? '💳 Carte' : '🚚 À la livraison' }}
                            —
                            @if($order->payment)
                                <span class="{{ $order->payment->status === 'paid' ? 'text-green-400' : 'text-yellow-400' }}">
                                    {{ $order->payment->status === 'paid' ? 'Payé' : 'En attente' }}
                                </span>
                            @endif
                        </p>
                    </div>

                </div>

            </div>
            @endforeach
        </div>

    @endif

</div>
</body>
</html>