<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande confirmée — MyShop</title>
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
<body class="text-slate-700 antialiased min-h-screen relative overflow-x-hidden flex items-center justify-center p-4 sm:p-8">

    <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-md w-full relative z-10 text-center">
        
        <div class="premium-card rounded-[2.5rem] p-8 sm:p-10 shadow-xl bg-white space-y-6 relative overflow-hidden">
            
            <div class="relative mx-auto w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-3xl shadow-sm border border-emerald-100/80">
                <i class="fas fa-check-circle"></i>
                <div class="absolute inset-0 rounded-full bg-emerald-500/10 animate-ping opacity-25"></div>
            </div>

            <div class="space-y-2">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-wider mx-auto">
                    Paiement & Commande validés
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase italic pt-1">
                    Merci pour votre <span class="text-blue-600 not-italic">confiance</span>
                </h1>
                <p class="text-slate-400 text-xs font-medium max-w-xs mx-auto leading-relaxed">
                    Votre commande a été enregistrée avec succès. Notre équipe prépare déjà votre colis informatique.
                </p>
            </div>

            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 flex items-center gap-3 text-left">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs shrink-0">
                    <i class="fas fa-truck-ramp-box"></i>
                </div>
                <div class="space-y-0.5">
                    <p class="text-[11px] font-extrabold text-slate-900 uppercase tracking-wider">Livraison Express active</p>
                    <p class="text-[10px] text-slate-400 font-semibold">Un agent vous contactera par téléphone avant le passage.</p>
                </div>
            </div>

            <div class="space-y-3 pt-2">
                <a href="{{ route('products.index') }}"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl uppercase tracking-wider text-xs smooth-transition shadow-lg shadow-blue-600/15 hover:shadow-none hover:translate-y-[-1px]">
                    Continuer mes achats <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
                
                <a href="{{ route('order.my') ?? '#' }}" 
                   class="inline-block text-[11px] font-bold text-slate-400 hover:text-slate-900 smooth-transition underline underline-offset-4">
                    Suivre l'état de ma commande
                </a>
            </div>

        </div>

        <p class="text-[10px] text-slate-400 font-semibold mt-6 tracking-wide uppercase">
            <i class="fas fa-shield-alt text-emerald-600 mr-1"></i> MyShop — Distributeur officiel
        </p>

    </div>

</body>
</html>