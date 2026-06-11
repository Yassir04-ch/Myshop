<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased min-h-screen selection:bg-indigo-600/10 selection:text-indigo-900">

    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none z-0"></div>

    <div class="max-w-4xl mx-auto px-4 py-12 sm:py-20 relative z-10">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-6 mb-8">
            <div class="space-y-1">
                <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-2.5 py-1 rounded-md">Review Order</span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3 mt-1">
                    Mon Panier
                </h1>
            </div>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-900 bg-slate-50 hover:bg-slate-100 border border-slate-200/60 px-4 py-2.5 rounded-xl transition-all">
                <i class="fas fa-arrow-left text-[10px]"></i> Continuer les achats
            </a>
        </div>

        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3.5 rounded-2xl mb-6 shadow-sm">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 shadow-sm">
                <i class="fas fa-exclamation-circle text-rose-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        @if(empty($items))
            <div class="text-center py-24 bg-slate-50/50 border border-slate-100 rounded-3xl relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-b from-white/50 to-transparent pointer-events-none"></div>
                <div class="w-16 h-16 bg-white border border-slate-100 rounded-2xl shadow-sm flex items-center justify-center mx-auto mb-5 text-2xl text-slate-400">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900">Votre panier est encore vide</h3>
                <p class="text-sm text-slate-400 font-medium mt-1 max-w-xs mx-auto">Découvrez nos derniers gadgets high-tech et cumulez vos points.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 mt-6 bg-slate-900 hover:bg-indigo-600 text-white font-bold px-6 py-3.5 rounded-xl text-xs uppercase tracking-wider transition-all shadow-sm">
                    Voir les produits <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

        @else

            <div class="grid lg:grid-cols-3 gap-8 items-start">
                
                <div class="lg:col-span-2 space-y-4">
                    @foreach($items as $id => $item)
                    <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-[0_8px_30px_rgba(0,0,0,0.01)] hover:border-slate-200 transition-all group">
                        
                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-slate-50 border border-slate-100 rounded-xl overflow-hidden flex items-center justify-center p-2 shrink-0 group-hover:border-indigo-500/10 transition-all">
                                @if(!empty($item['attributes']['image']) || !empty($item['image']))
                                    <img src="{{ asset('storage/' . ($item['attributes']['image'] ?? $item['image'])) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="object-contain w-full h-full transform group-hover:scale-105 transition-all duration-350">
                                @else
                                    <i class="fas fa-microchip text-slate-300 text-xl"></i>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h4 class="font-bold text-slate-900 text-sm sm:text-base tracking-tight truncate group-hover:text-indigo-600 transition-colors">
                                    {{ $item['name'] }}
                                </h4>
                                <p class="text-xs text-slate-400 font-semibold mt-1">
                                    {{ number_format($item['price'], 2) }} <span class="text-[10px]">DH</span> / unité
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between sm:justify-end gap-4 sm:gap-6 shrink-0 border-t sm:border-t-0 pt-3 sm:pt-0 border-slate-50">
                            
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center bg-slate-50 border border-slate-200/70 p-1 rounded-xl">
                                @csrf 
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="w-10 bg-transparent text-slate-900 text-center font-bold text-xs focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="submit" class="text-[10px] bg-white hover:bg-indigo-600 text-slate-500 hover:text-white w-6 h-6 rounded-lg flex items-center justify-center transition-all border border-slate-100 shadow-sm" title="Mettre à jour">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>

                            <div class="text-right w-24">
                                <p class="text-slate-900 font-extrabold text-sm sm:text-base tracking-tight">
                                    {{ number_format($item['price'] * $item['quantity'], 2) }} <span class="text-xs font-bold text-slate-400">DH</span>
                                </p>
                            </div>

                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button class="text-slate-300 hover:text-rose-500 hover:bg-rose-50/60 w-8 h-8 rounded-xl flex items-center justify-center text-xs transition-all border border-transparent hover:border-rose-100" title="Supprimer">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>

                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 space-y-6 lg:sticky lg:top-6">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Résumé de la commande</h3>
                    
                    <div class="space-y-3 border-b border-slate-200/60 pb-4">
                        <div class="flex justify-between text-xs font-semibold text-slate-400">
                            <span>Sous-total</span>
                            <span class="text-slate-700">{{ number_format($total, 2) }} DH</span>
                        </div>
                        <div class="flex justify-between text-xs font-semibold text-slate-400">
                            <span>Livraison</span>
                            <span class="text-emerald-600 font-bold bg-emerald-50 px-1.5 py-0.5 rounded">Gratuite</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-baseline">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wider">Total</span>
                        <span class="text-2xl font-black text-slate-900 tracking-tight">
                            {{ number_format($total, 2) }} <span class="text-sm font-extrabold">DH</span>
                        </span>
                    </div>

                    <div class="space-y-2 pt-2">
                        <a href="{{ route('order.checkout') }}"
                            class="flex items-center justify-center gap-2 w-full text-center bg-indigo-600 hover:bg-slate-900 text-white font-bold py-4 rounded-xl uppercase tracking-wider text-xs transition-all shadow-md shadow-indigo-600/10 hover:shadow-none">
                            Passer la commande <i class="fas fa-chevron-right text-[9px]"></i>
                        </a>
                        <p class="text-[10px] text-center text-slate-400 font-medium">Paiement sécurisé à la livraison ou par carte.</p>
                    </div>
                </div>

            </div>

        @endif

    </div>
</body>
</html>