<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — MyShop</title>
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
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="text-slate-700 antialiased min-h-screen relative overflow-x-hidden selection:bg-blue-500/10 selection:text-blue-800 p-4 sm:p-8 lg:p-12">

    <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-blue-500/5 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute bottom-[5%] left-[-15%] w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[130px] pointer-events-none"></div>

    <div class="max-w-5xl mx-auto relative z-10 space-y-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200 pb-6">
            <div class="space-y-1">
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-blue-50 border border-blue-100 text-blue-600 text-[10px] font-black uppercase tracking-wider">
                    <i class="fas fa-shield-alt text-[9px]"></i> Secure Checkout Process
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight italic uppercase mt-1">
                    Valider la <span class="text-blue-600 not-italic">commande</span>
                </h1>
            </div>
            <a href="{{ route('cart.index') }}"
                class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-slate-900 bg-white border border-slate-200 px-4 py-2.5 rounded-xl smooth-transition hover:bg-slate-50 shadow-sm">
                <i class="fas fa-arrow-left text-[10px]"></i> Retour au panier
            </a>
        </div>

        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3.5 rounded-2xl shadow-sm">
                <i class="fas fa-exclamation-circle text-rose-500 text-base shrink-0"></i>
                <span class="text-xs font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            
            <div class="grid lg:grid-cols-12 gap-8 items-start">
                
                <div class="lg:col-span-7 space-y-6">
                    
                    <div class="premium-card rounded-2xl p-5 sm:p-6 space-y-4 shadow-sm bg-white">
                        <div class="flex items-center gap-2 text-slate-900 font-extrabold text-xs uppercase tracking-wider border-b border-slate-100 pb-3">
                            <i class="fas fa-user text-blue-600 text-[11px]"></i>
                            <span>Vos informations personnelles</span>
                        </div>
                        
                        <div class="grid gap-3.5 pt-1">
                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 px-4 py-3 rounded-xl">
                                <span class="text-slate-400 text-xs w-5"><i class="fas fa-id-badge"></i></span>
                                <span class="text-sm font-semibold text-slate-800">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
                            </div>
                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 px-4 py-3 rounded-xl">
                                <span class="text-slate-400 text-xs w-5"><i class="fas fa-envelope"></i></span>
                                <span class="text-sm font-semibold text-slate-800">{{ auth()->user()->email }}</span>
                            </div>
                            @if(auth()->user()->phone)
                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 px-4 py-3 rounded-xl">
                                <span class="text-slate-400 text-xs w-5"><i class="fas fa-phone"></i></span>
                                <span class="text-sm font-semibold text-slate-800">{{ auth()->user()->phone }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="premium-card rounded-2xl p-5 sm:p-6 space-y-4 shadow-sm bg-white">
                        <div class="flex items-center gap-2 text-slate-900 font-extrabold text-xs uppercase tracking-wider border-b border-slate-100 pb-3">
                            <i class="fas fa-map-marker-alt text-blue-600 text-[11px]"></i>
                            <span>Adresse de livraison</span>
                        </div>

                        <div class="space-y-4 pt-1">
                            <div>
                                <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5 block">Adresse Complète</label>
                                <div class="relative">
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="w-full bg-slate-50 text-slate-900 rounded-xl pl-4 pr-4 py-3 text-xs font-semibold border border-slate-200 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 smooth-transition placeholder-slate-400"
                                        placeholder="N° de rue, quartier, étage...">
                                </div>
                                @error('address') <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5 block">Ville</label>
                                    <input type="text" name="city" value="{{ old('city') }}"
                                        class="w-full bg-slate-50 text-slate-900 rounded-xl px-4 py-3 text-xs font-semibold border border-slate-200 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 smooth-transition placeholder-slate-400"
                                        placeholder="Casablanca">
                                    @error('city') <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5 block">Code postal</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                        class="w-full bg-slate-50 text-slate-900 rounded-xl px-4 py-3 text-xs font-semibold border border-slate-200 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/5 smooth-transition placeholder-slate-400"
                                        placeholder="20000">
                                    @error('postal_code') <p class="text-rose-500 text-[11px] font-medium mt-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-[11px] font-black text-slate-500 uppercase tracking-wider pl-1">Mode de paiement hébergé</p>

                        <div class="grid gap-3">
                            <label class="group flex items-start gap-4 bg-white border border-slate-200 hover:border-blue-500/50 rounded-2xl p-4 cursor-pointer smooth-transition relative overflow-hidden shadow-sm">
                                <input type="radio" name="payment_method" value="cart" class="accent-blue-600 mt-1 h-3.5 w-3.5 shrink-0">
                                <div class="space-y-0.5">
                                    <p class="font-extrabold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                        <i class="fas fa-credit-card text-blue-600"></i> Payer par carte bancaire
                                    </p>
                                    <p class="text-[11px] text-slate-500 font-medium">Paiement instantané et hautement sécurisé via passerelle marocaine.</p>
                                </div>
                            </label>

                            <label class="group flex items-start gap-4 bg-white border border-slate-200 hover:border-blue-500/50 rounded-2xl p-4 cursor-pointer smooth-transition relative overflow-hidden shadow-sm">
                                <input type="radio" name="payment_method" value="livraison" class="accent-blue-600 mt-1 h-3.5 w-3.5 shrink-0">
                                <div class="space-y-0.5">
                                    <p class="font-extrabold text-slate-900 text-xs sm:text-sm flex items-center gap-2">
                                        <i class="fas fa-truck text-indigo-600"></i> Payer cash à la livraison
                                    </p>
                                    <p class="text-[11px] text-slate-500 font-medium">Réglez le montant en espèces dès réception de votre colis informatique.</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="text-rose-500 text-[11px] font-medium mt-1 pl-1"><i class="fas fa-circle-exclamation mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="lg:col-span-5 lg:sticky lg:top-12 space-y-4">
                    
                    <div class="premium-card rounded-[2rem] p-6 space-y-6 shadow-md bg-white">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Résumé du Panier</h3>
                            <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded text-slate-600 font-bold">{{ count($items) }} articles</span>
                        </div>
                        
                        <div class="max-h-60 overflow-y-auto space-y-3.5 pr-1">
                            @foreach($items as $item)
                            <div class="flex justify-between items-start text-xs gap-4">
                                <div class="flex flex-col min-w-0">
                                    <span class="text-slate-800 font-bold truncate">{{ $item['name'] }}</span>
                                    <span class="text-slate-400 text-[10px] font-semibold mt-0.5">Quantité: {{ $item['quantity'] }}</span>
                                </div>
                                <span class="text-blue-600 font-extrabold tracking-tight shrink-0">
                                    {{ number_format($item['price'] * $item['quantity'], 2) }} <span class="text-[10px] font-medium text-slate-400">DH</span>
                                </span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-3 border-t border-slate-100 pt-4">
                            <div class="flex justify-between text-[11px] font-bold text-slate-400">
                                <span>Expédition logistique</span>
                                <span class="text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded text-[10px] font-bold">Offerte</span>
                            </div>
                            <div class="flex justify-between items-baseline pt-2">
                                <span class="text-xs font-black text-slate-900 uppercase tracking-wider">Total TTC</span>
                                <span class="text-2xl font-black text-slate-900 tracking-tight">
                                    {{ number_format($total, 2) }} <span class="text-xs font-bold text-slate-500">DH</span>
                                </span>
                            </div>
                        </div>

                        <div class="space-y-3 pt-2">
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl uppercase tracking-wider text-xs smooth-transition shadow-lg shadow-blue-600/20 hover:shadow-none hover:translate-y-[-1px]">
                                Confirmer la commande <i class="fas fa-check-circle text-[11px]"></i>
                            </button>
                            <p class="text-[10px] text-center text-slate-400 font-semibold flex items-center justify-center gap-1.5">
                                <i class="fas fa-lock text-[9px] text-emerald-600"></i> Encryption TLS 256-bit active.
                            </p>
                        </div>
                    </div>
                    
                </div>

            </div>
        </form>

    </div>
</body>
</html>