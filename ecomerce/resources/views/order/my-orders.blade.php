<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes commandes — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc; /* Slate 50 */
        }
        .premium-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.04);
        }
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-slate-700 antialiased min-h-screen relative overflow-x-hidden selection:bg-blue-500/10 selection:text-blue-800 p-4 sm:p-8 lg:p-12">

    <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute bottom-[5%] left-[-15%] w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[130px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto relative z-10 space-y-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-6">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-blue-50 border border-blue-100 text-blue-600 text-[10px] font-black uppercase tracking-wider">
                    <i class="fas fa-history text-[9px]"></i> Historique d'achats
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase mt-1">
                    Mes <span class="text-blue-600 not-italic">commandes</span>
                </h1>
            </div>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2.5 rounded-xl smooth-transition hover:bg-slate-50 shadow-sm">
                <i class="fas fa-arrow-left text-[10px]"></i> Continuer les achats
            </a>
        </div>

        @if($orders->isEmpty())
            <div class="text-center py-20 bg-white border border-slate-100 rounded-[2rem] shadow-sm space-y-5">
                <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center text-2xl mx-auto border border-slate-100 shadow-inner">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-slate-900 font-extrabold text-base">Aucune commande trouvée</p>
                    <p class="text-slate-400 text-xs max-w-xs mx-auto">Vous n'avez pas encore passé de commande sur notre boutique pour le moment.</p>
                </div>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black px-6 py-3.5 rounded-xl text-xs uppercase tracking-wider smooth-transition shadow-lg shadow-blue-600/10 hover:shadow-none">
                    Découvrir les produits <i class="fas fa-shopping-bag text-[10px]"></i>
                </a>
            </div>

        @else

            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="premium-card rounded-2xl shadow-sm bg-white smooth-transition hover:shadow-md hover:-translate-y-0.5 overflow-hidden">

                    <div onclick="toggleOrderItems('order-{{ $order->id }}', this)" 
                         class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 cursor-pointer select-none bg-white smooth-transition hover:bg-slate-50/50">
                        
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-sm shrink-0">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-xs font-black text-slate-900">
                                        Commande #{{ $order->id }}
                                    </span>
                                    <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded font-bold">
                                        {{ count($order->items) }} {{ count($order->items) > 1 ? 'articles' : 'article' }}
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5">
                                    <i class="far fa-calendar-alt text-[10px]"></i> Le {{ $order->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between md:justify-end gap-6 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100">
                            <div class="md:text-right">
                                <p class="text-xs text-slate-400 font-bold">Total</p>
                                <p class="text-sm font-black text-slate-900 tracking-tight">
                                    {{ number_format($order->total_amount, 2) }} <span class="text-[10px] font-bold text-slate-400">DH</span>
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider inline-flex items-center gap-1 border
                                    @if($order->status === 'pending') bg-amber-50 text-amber-700 border-amber-200
                                    @elseif($order->status === 'processing') bg-blue-50 text-blue-700 border-blue-200
                                    @elseif($order->status === 'shipped') bg-indigo-50 text-indigo-700 border-indigo-200
                                    @elseif($order->status === 'delivered') bg-emerald-50 text-emerald-700 border-emerald-200
                                    @elseif($order->status === 'cancelled') bg-rose-50 text-rose-700 border-rose-200
                                    @endif">
                                    
                                    @if($order->status === 'pending') <i class="fas fa-clock text-[9px]"></i> En attente
                                    @elseif($order->status === 'processing') <i class="fas fa-spinner fa-spin text-[9px]"></i> En traitement
                                    @elseif($order->status === 'shipped') <i class="fas fa-shipping-fast text-[9px]"></i> Expédié
                                    @elseif($order->status === 'delivered') <i class="fas fa-check-circle text-[9px]"></i> Livré
                                    @elseif($order->status === 'cancelled') <i class="fas fa-times-circle text-[9px]"></i> Annulé
                                    @endif
                                </span>

                                <div class="w-7 h-7 rounded-full bg-slate-50 border border-slate-200/60 flex items-center justify-center text-slate-400 text-xs smooth-transition chevron-icon">
                                    <i class="fas fa-chevron-down smooth-transition"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="order-{{ $order->id }}" class="hidden border-t border-slate-100 bg-slate-50/30 smooth-transition">
                        <div class="p-5 sm:p-6 space-y-6">
                            
                            @php
                                $steps = ['pending', 'processing', 'shipped', 'delivered'];
                                $currentStep = array_search($order->status, $steps);
                            @endphp
                            @if($order->status !== 'cancelled')
                            <div class="bg-white border border-slate-200/60 rounded-xl p-4 shadow-inner-sm">
                                <div class="flex flex-row items-center justify-between gap-2">
                                    @foreach([
                                        ['label' => 'Reçue', 'icon' => 'fa-file-invoice'],
                                        ['label' => 'Traitement', 'icon' => 'fa-cog'],
                                        ['label' => 'Expédié', 'icon' => 'fa-truck'],
                                        ['label' => 'Livré', 'icon' => 'fa-box']
                                    ] as $i => $stepItem)
                                    <div class="flex-1 text-center space-y-1.5">
                                        <div class="h-1.5 rounded-full {{ $i <= $currentStep ? 'bg-blue-600' : 'bg-slate-200' }} smooth-transition"></div>
                                        <p class="text-[9px] font-black uppercase tracking-wider {{ $i <= $currentStep ? 'text-blue-600' : 'text-slate-400' }}">
                                            {{ $stepItem['label'] }}
                                        </p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="space-y-2">
                                <p class="text-[10px] font-black uppercase text-slate-400 tracking-wider px-1">Détail des articles achetés</p>
                                
                                <div class="divide-y divide-slate-100 bg-white border border-slate-200/60 rounded-xl px-4 shadow-sm">
                                    @foreach($order->items as $item)
                                    <div class="flex justify-between items-center py-3.5 text-xs sm:text-sm gap-4 group/item">
                                        <div class="min-w-0 flex items-center gap-3">
                                            <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-[11px] font-bold">
                                                ×{{ $item->quantity }}
                                            </div>
                                            <div>
                                                <span class="text-slate-800 font-bold block truncate smooth-transition group-hover/item:text-blue-600">
                                                    {{ $item->product->name }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-slate-900 font-extrabold tracking-tight whitespace-nowrap">
                                            {{ number_format($item->price * $item->quantity, 2) }} <span class="text-[10px] font-medium text-slate-400">DH</span>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4 pt-2">
                                <div class="bg-white border border-slate-200/60 rounded-xl p-4 space-y-1.5 shadow-sm">
                                    <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block"><i class="fas fa-map-pin text-blue-500 mr-1"></i> Destination de Livraison</span>
                                    <p class="text-xs font-bold text-slate-700 leading-relaxed">
                                        {{ $order->address }}, {{ $order->city }} {{ $order->postal_code }}
                                    </p>
                                </div>
                                
                                <div class="bg-white border border-slate-200/60 rounded-xl p-4 space-y-1.5 shadow-sm flex flex-col justify-between">
                                 <div>
                                    <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block">
                                        <i class="fas fa-credit-card text-indigo-500 mr-1"></i>
                                        Facturation & Paiement
                                    </span>

                                    <p class="text-xs font-bold text-slate-700 mt-1">
                                        @if($order->payment_method === 'cart')
                                            💳 Carte Bancaire
                                        @elseif($order->payment_method === 'points')
                                            🎁 Paiement par Points
                                        @else
                                            🚚 Cash à la livraison
                                        @endif
                                    </p>
                                </div>
                                    @if($order->payment)
                                    <div class="pt-2 border-t border-slate-100 mt-2 flex items-center justify-between">
                                        <span class="text-[10px] font-bold text-slate-400">Transaction:</span>
                                        <span class="px-2 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider
                                            {{ $order->payment->status === 'paid' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                            {{ $order->payment->status === 'paid' ? 'Payé' : 'En attente' }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                @endforeach
            </div>

        @endif

    </div>

    <script>
        function toggleOrderItems(orderId, headerElement) {
            const container = document.getElementById(orderId);
            const chevron = headerElement.querySelector('.chevron-icon');
            
            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                chevron.classList.add('rotate-180', 'bg-blue-50', 'text-blue-600', 'border-blue-200');
            } else {
                container.classList.add('hidden');
                chevron.classList.remove('rotate-180', 'bg-blue-50', 'text-blue-600', 'border-blue-200');
            }
        }
    </script>
</body>
</html>