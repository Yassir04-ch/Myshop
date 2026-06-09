<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Commande - ElectroPro Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans p-4 sm:p-8 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-[2rem] p-6 sm:p-8 shadow-[0_20px_50px_rgba(148,163,184,0.15)] border border-slate-100 relative overflow-hidden group">
        
        <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>

        <div class="flex items-center justify-between gap-4 mb-6 pb-5 border-b border-slate-100">
            <div class="space-y-0.5">
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600 block">Notification</span>
                <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">
                    🛒 Nouvelle commande
                </h2>
            </div>
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200/60 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    En attente
                </span>
            </div>
        </div>

        <div class="space-y-1">
            
            <div class="flex items-center justify-between py-3 px-2 rounded-xl transition-all duration-200 hover:bg-slate-50">
                <span class="text-slate-500 text-sm font-medium flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                        <i class="fas fa-user text-xs"></i>
                    </div>
                    Client
                </span>
                <span class="text-slate-900 text-sm font-bold">{{ $order->user->name }}</span>
            </div>

            <div class="flex items-center justify-between py-3 px-2 rounded-xl transition-all duration-200 hover:bg-slate-50">
                <span class="text-slate-500 text-sm font-medium flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                        <i class="fas fa-envelope text-xs"></i>
                    </div>
                    Email
                </span>
                <span class="text-slate-700 text-sm font-medium truncate max-w-[180px] sm:max-w-none">{{ $order->user->email }}</span>
            </div>

            <div class="flex items-center justify-between py-3 px-2 rounded-xl transition-all duration-200 hover:bg-slate-50">
                <span class="text-slate-500 text-sm font-medium flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                        <i class="fas fa-calendar-alt text-xs"></i>
                    </div>
                    Date
                </span>
                <span class="text-slate-600 text-sm font-semibold">{{ $order->created_at }}</span>
            </div>

            <div class="h-[1px] w-full bg-slate-100 my-3"></div>

            <div class="flex items-center justify-between py-3 px-3 bg-blue-50/40 rounded-xl border border-blue-100/50">
                <span class="text-slate-700 text-sm font-bold flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-500 flex items-center justify-center text-white shadow-sm">
                        <i class="fas fa-wallet text-xs"></i>
                    </div>
                    Montant Total
                </span>
                <span class="text-blue-600 text-xl font-black tracking-tight">
                    {{ $order->total_amount }} <span class="text-xs font-bold text-blue-500">DH</span>
                </span>
            </div>

        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/orders/'.$order->id) }}" 
               class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-blue-600 text-white px-6 py-3.5 rounded-xl text-sm font-bold tracking-wide transition-all duration-200 shadow-md hover:shadow-lg hover:shadow-blue-600/10 active:scale-[0.99]">
               Voir la commande <i class="fas fa-arrow-right text-xs ml-0.5"></i>
            </a>
        </div>

    </div>

</body>
</html>