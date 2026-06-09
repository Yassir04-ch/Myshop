<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f8fafc; }
    </style>
</head>
<body class="text-slate-600 antialiased font-sans bg-[#f8fafc]">

    {{-- Nav --}}
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
                        <a href="{{ route('products.index') }}" class="text-slate-400 hover:text-slate-900 transition-colors">Products</a>
                        <a href="{{ route('orders') }}" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Orders</a>
                        <a href="{{ route('clients') }}" class="text-slate-400 hover:text-slate-900 transition-colors">Users</a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-400 bg-slate-100 px-3 py-1.5 rounded-xl">
                        📅 {{ date('d M Y') }}
                    </span>
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-700 text-xs">AD</div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 border-b border-slate-200/60 pb-6">
                <div>
                    <h1 class="font-black text-3xl text-slate-900 tracking-tight uppercase">Orders</h1>
                    <p class="text-slate-400 text-xs mt-0.5">Gérez et suivez toutes les commandes clients.</p>
                </div>
            </div>

            {{-- Flash --}}
            @if(session('success'))
            <div class="flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)]">
                    <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Total</span>
                    <span class="text-2xl font-black text-slate-800 block mt-1">{{ $orders->count() }}</span>
                </div>
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)]">
                    <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">En attente</span>
                    <span class="text-2xl font-black text-amber-500 block mt-1">{{ $orders->where('status','pending')->count() }}</span>
                </div>
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)]">
                    <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Processing</span>
                    <span class="text-2xl font-black text-blue-500 block mt-1">{{ $orders->where('status','processing')->count() }}</span>
                </div>
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)]">
                    <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Livrées</span>
                    <span class="text-2xl font-black text-emerald-600 block mt-1">{{ $orders->where('status','delivered')->count() }}</span>
                </div>
                <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.01)]">
                    <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider block">Annulées</span>
                    <span class="text-2xl font-black text-red-500 block mt-1">{{ $orders->where('status','cancelled')->count() }}</span>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.01)] border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-slate-400 text-[10px] font-black uppercase tracking-wider border-b border-slate-100">
                                <th class="p-4 pl-8">Order</th>
                                <th class="p-4">Client</th>
                                <th class="p-4">Adresse</th>
                                <th class="p-4">Paiement</th>
                                <th class="p-4">Total</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Statut</th>
                                <th class="p-4 pr-8 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100/70">

                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/40 transition-colors group">

                                {{-- Order ID --}}
                                <td class="p-4 pl-8 font-mono text-xs text-slate-400 font-bold">
                                    #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- Client --}}
                                <td class="p-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold shrink-0">
                                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800 text-xs leading-tight">{{ $order->user->name ?? '—' }}</p>
                                            <p class="text-[11px] text-slate-400">{{ $order->user->email ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Adresse --}}
                                <td class="p-4">
                                    <p class="text-xs text-slate-700 font-medium">{{ $order->city }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $order->address }}, {{ $order->postal_code }}</p>
                                </td>

                                {{-- Payment --}}
                                <td class="p-4">
                                    @if($order->payment_method === 'cart')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-violet-50 text-violet-700 text-xs font-semibold rounded-full border border-violet-100/30">
                                            💳 Stripe
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full border border-amber-100/30">
                                            🚚 Livraison
                                        </span>
                                    @endif
                                    {{-- Payment status --}}
                                    @if($order->payment)
                                        <p class="text-[10px] mt-0.5 {{ $order->payment->status === 'paid' ? 'text-emerald-500' : 'text-slate-400' }}">
                                            {{ ucfirst($order->payment->status) }}
                                        </p>
                                    @endif
                                </td>

                                {{-- Total --}}
                                <td class="p-4 font-black text-slate-800 text-sm">
                                    {{ number_format($order->total_amount, 2) }}
                                    <span class="text-xs text-slate-400 font-semibold">DH</span>
                                </td>

                                {{-- Date --}}
                                <td class="p-4 text-xs text-slate-400 font-mono">
                                    {{ $order->created_at->format('d M Y') }}<br>
                                    <span class="text-[10px]">{{ $order->created_at->format('H:i') }}</span>
                                </td>

                                <td class="p-4">
                                    @php
                                        $statusConfig = [
                                            'pending'    => ['bg-amber-50',   'text-amber-600',   'bg-amber-400',   '⏳ Pending'],
                                            'processing' => ['bg-blue-50',    'text-blue-600',    'bg-blue-400',    '⚙️ Processing'],
                                            'accepted' => ['bg-emerald-50', 'text-emerald-600', 'bg-emerald-400', '✅ Accepted'],
                                            'shipped'    => ['bg-indigo-50',  'text-indigo-600',  'bg-indigo-400',  '📦 Shipped'],
                                            'delivered'  => ['bg-emerald-50', 'text-emerald-600', 'bg-emerald-500', '✅ Delivered'],
                                            'cancelled'  => ['bg-red-50',     'text-red-500',     'bg-red-400',     '❌ Cancelled'],
                                        ];
                                        $cfg = $statusConfig[$order->status] ?? ['bg-slate-100','text-slate-500','bg-slate-400','— Unknown'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 {{ $cfg[0] }} {{ $cfg[1] }} text-xs font-semibold rounded-full">
                                        {{ $cfg[3] }}
                                    </span>
                                </td>

                               <td class="p-4 pr-8 text-right">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('orders.show', $order) }}"
                                        class="text-xs px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold transition-all active:scale-95">
                                        🔍 Détail
                                    </a>

                                    <form action="{{ route('orders.status', $order) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status"
                                            class="text-xs border border-slate-200 rounded-xl px-2 py-1.5 bg-white text-slate-600 font-semibold focus:outline-none focus:border-indigo-400 cursor-pointer">
                                            @foreach(['pending','processing','accepted','shipped','delivered','cancelled'] as $s)
                                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                                    {{ ucfirst($s) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                            class="text-xs px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-all active:scale-95">
                                            ✓
                                        </button>
                                    </form>

                                </div>
                            </td>


                            </tr>

                            {{-- Items détail row --}}
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <td colspan="8" class="px-8 py-2">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($order->items as $item)
                                        <span class="inline-flex items-center gap-1.5 text-[11px] bg-white border border-slate-200 text-slate-600 px-2.5 py-1 rounded-lg font-medium">
                                            📦 {{ $item->product->name ?? 'Produit supprimé' }}
                                            <span class="text-slate-400">x{{ $item->quantity }}</span>
                                            <span class="text-slate-400">·</span>
                                            <span class="font-bold text-slate-700">{{ number_format($item->price, 2) }} DH</span>
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="8" class="p-12 text-center text-slate-400 text-sm">
                                    Aucune commande trouvée.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="p-5 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-xs font-semibold text-slate-400">
                    <span>{{ $orders->count() }} commande(s) au total</span>
                    <span class="font-black text-slate-700">
                        Total revenue :
                        {{ number_format($orders->whereIn('status', ['processing','shipped','delivered'])->sum('total_amount'), 2) }} DH
                    </span>
                </div>

            </div>
        </div>
    </main>

</body>
</html>