<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande #{{ $order->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc] text-slate-600 antialiased font-sans">

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
                        <a href="{{ route('productsadmin') }}" class="text-slate-400 hover:text-slate-900 transition-colors">Products</a>
                        <a href="{{ route('categories.index') }}" class="text-slate-400 hover:text-slate-900 transition-colors">categories</a>
                        <a href="/admin/orders" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Orders</a>
                        <a href="/clients" class="text-slate-400 hover:text-slate-900 transition-colors">Users</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{route('orders')}}"
                        class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all">
                        ⬅️ Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200/60 pb-6">
                <div>
                    <h1 class="font-black text-3xl text-slate-900 tracking-tight uppercase">
                        Commande <span class="text-indigo-600">#{{ $order->id }}</span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-0.5">
                        Passée le {{ $order->created_at ? $order->created_at->format('d/m/Y à H:i') : '—' }}
                    </p>
                </div>

                {{-- Status badge --}}
                @php
                    $statusConfig = [
                        'pending'    => ['bg-amber-50',   'text-amber-700',   'border-amber-200',   '⏳ En attente'],
                        'processing' => ['bg-blue-50',    'text-blue-700',    'border-blue-200',    '🔄 En traitement'],
                        'shipped'    => ['bg-indigo-50',  'text-indigo-700',  'border-indigo-200',  '🚚 Expédiée'],
                        'delivered'  => ['bg-emerald-50', 'text-emerald-700', 'border-emerald-200', '✅ Livrée'],
                        'cancelled'  => ['bg-red-50',     'text-red-700',     'border-red-200',     '❌ Annulée'],
                    ];
                    $s = $statusConfig[$order->status] ?? ['bg-slate-50', 'text-slate-700', 'border-slate-200', $order->status];
                @endphp
                <span class="px-4 py-2 rounded-xl text-xs font-bold border {{ $s[0] }} {{ $s[1] }} {{ $s[2] }}">
                    {{ $s[3] }}
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT: Items + Payment --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Order Items --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <h2 class="text-[11px] font-black uppercase tracking-wider text-slate-400 mb-4">
                            🛒 Articles commandés
                        </h2>

                        <div class="space-y-3">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-50/50 border border-slate-100">

                                {{-- Product image --}}
                                @if($item->product && $item->product->images->count())
                                    <img src="{{ asset('storage/' . $item->product->images->first()->image) }}"
                                        class="w-14 h-14 object-cover rounded-xl border border-slate-200 shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                                        <span class="text-xl">📦</span>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-slate-800 truncate">
                                        {{ $item->product->name ?? 'Produit supprimé' }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        {{ number_format($item->price, 2) }} DH × {{ $item->quantity }}
                                    </p>
                                </div>

                                <div class="text-right shrink-0">
                                    <p class="text-sm font-black text-slate-900">
                                        {{ number_format($item->price * $item->quantity, 2) }} DH
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Total --}}
                        <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center">
                            <span class="text-xs font-black uppercase tracking-wider text-slate-400">Total</span>
                            <span class="text-xl font-black text-indigo-600">
                                {{ number_format($order->total_amount, 2) }} DH
                            </span>
                        </div>
                    </div>

                    {{-- Payment --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <h2 class="text-[11px] font-black uppercase tracking-wider text-slate-400 mb-4">
                            💳 Paiement
                        </h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                                    Méthode
                                </p>

                                <p class="text-sm font-bold text-slate-800">
                                    @if($order->payment_method === 'livraison')
                                        🚚 À la livraison
                                    @elseif($order->payment_method === 'points')
                                        🎁 Paiement par points
                                    @else
                                        💳 Carte bancaire
                                    @endif
                                </p>
                            </div>

                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Statut</p>
                                @if($order->payment)
                                    @php
                                        $pConfig = [
                                            'paid'    => ['text-emerald-700', 'bg-emerald-50', '✅ Payé'],
                                            'pending' => ['text-amber-700',   'bg-amber-50',   '⏳ En attente'],
                                            'failed'  => ['text-red-700',     'bg-red-50',     '❌ Échoué'],
                                        ];
                                        $p = $pConfig[$order->payment->status] ?? ['text-slate-700', 'bg-slate-50', $order->payment->status];
                                    @endphp
                                    <span class="text-sm font-bold {{ $p[0] }}">{{ $p[2] }}</span>
                                @else
                                    <span class="text-sm font-bold text-slate-400">—</span>
                                @endif
                            </div>

                            @if($order->stripe_session_id)
                            <div class="col-span-2 bg-slate-50 rounded-xl p-4">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Stripe Session ID</p>
                                <p class="text-xs font-mono text-slate-600 break-all">{{ $order->stripe_session_id }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- RIGHT: Client + Livraison + Actions --}}
                <div class="space-y-6">

                    {{-- Client --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <h2 class="text-[11px] font-black uppercase tracking-wider text-slate-400 mb-4">
                            👤 Client
                        </h2>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center shrink-0">
                                <span class="text-indigo-600 font-black text-sm">
                                    {{ strtoupper(substr($order->user->firstname, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">
                                    {{ $order->user->firstname }} {{ $order->user->lastname }}
                                </p>
                                <p class="text-xs text-slate-400">{{ $order->user->email }}</p>
                                
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->phone) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-1 text-xs text-emerald-600 hover:text-emerald-700 font-semibold transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.561 4.14 1.535 5.874L.057 23.886a.5.5 0 00.606.665l6.188-1.62A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.878 9.878 0 01-5.031-1.378l-.36-.214-3.733.978.995-3.63-.235-.374A9.867 9.867 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106S21.894 6.58 21.894 12 17.42 21.894 12 21.894z"/>
                                    </svg>
                                    {{ $order->user->phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Livraison --}}
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
                        <h2 class="text-[11px] font-black uppercase tracking-wider text-slate-400 mb-4">
                            📍 Adresse de livraison
                        </h2>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400 text-xs">Adresse</span>
                                <span class="font-semibold text-slate-800 text-right max-w-[60%]">{{ $order->address }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400 text-xs">Ville</span>
                                <span class="font-semibold text-slate-800">{{ $order->city }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400 text-xs">Code postal</span>
                                <span class="font-semibold text-slate-800">{{ $order->postal_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>