<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MyShop - Admin Clients</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .smooth-transition { transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1); }
  </style>
</head>
<body class="bg-[#f8fafc] text-slate-600 antialiased min-h-screen flex flex-col selection:bg-indigo-500/10 selection:text-indigo-800">

  <header class="w-full h-16 bg-white border-b border-slate-100 fixed top-0 z-50 flex items-center justify-between px-6 shadow-sm shadow-slate-100/40">
    <div class="flex items-center gap-2.5">
      <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-md shadow-indigo-200">
        <i class="fas fa-microchip text-sm"></i>
      </div>
      <span class="text-base font-black text-slate-900 tracking-tight">My<span class="text-indigo-600">Shop</span></span>
    </div>

    <div class="flex items-center gap-4">
      <button class="relative w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-indigo-600 hover:bg-slate-50 smooth-transition">
        <i class="far fa-bell text-base"></i>
        <span class="absolute top-2.5 right-2.5 w-1.5 h-1.5 rounded-full bg-indigo-600 ring-2 ring-white animate-pulse"></span>
      </button>

      <div class="h-5 w-[1px] bg-slate-200/60"></div>

      <div class="flex items-center gap-2.5 cursor-pointer group">
        <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-slate-700 font-extrabold text-xs uppercase group-hover:border-indigo-200 smooth-transition">
          AD
        </div>
        <div class="hidden sm:block text-left">
          <p class="text-xs font-bold text-slate-900 leading-none">Admin</p>
          <p class="text-[10px] font-medium text-slate-400 mt-1">Propriétaire</p>
        </div>
        <i class="fas fa-chevron-down text-[9px] text-slate-400 group-hover:text-slate-600 smooth-transition ml-0.5"></i>
      </div>
    </div>
  </header>

  <div class="flex flex-1 pt-16">
    
    <aside class="w-64 bg-slate-900 text-slate-400 fixed top-16 bottom-0 left-0 z-40 hidden md:flex flex-col justify-between p-4 border-r border-slate-800/40 shadow-xl">
      <div class="space-y-6 mt-3">
        <div>
          <p class="px-3 text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Menu Principal</p>
          <nav class="space-y-1">
            <a href="{{route('dashboard')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold smooth-transition hover:text-white hover:bg-slate-800/60">
              <i class="fas fa-chart-pie text-sm w-5"></i>
              Dashboard
            </a>
            <a href="{{route('productsadmin')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold smooth-transition hover:text-white hover:bg-slate-800/60">
              <i class="fas fa-box text-sm w-5"></i>
              Produits
            </a>
            <a href="{{route('orders')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold smooth-transition hover:text-white hover:bg-slate-800/60">
              <i class="fas fa-shopping-bag text-sm w-5"></i>
              Commandes
            </a>
            <a href="{{route('categories.index')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold smooth-transition hover:text-white hover:bg-slate-800/60">
              <i class="fas fa-tags text-sm w-5"></i>
              Catégories
            </a>
            <a href="{{route('clients')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 text-white shadow-lg shadow-indigo-600/10 smooth-transition">
              <i class="fas fa-users text-sm w-5"></i>
              Clients
            </a>
          </nav>
        </div>
      </div>

      <div class="border-t border-slate-800/60 pt-4 mb-2">
        <a href="{{route('logout')}}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:text-red-400 smooth-transition">
          <i class="fas fa-sign-out-alt text-sm w-5"></i>
          Déconnexion
        </a>
      </div>
    </aside>

    <main class="flex-1 md:ml-64 p-6 sm:p-10 relative">
      <div class="max-w-5xl mx-auto space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm relative overflow-hidden">
          <div class="space-y-0.5">
            <h1 class="text-xl font-black text-slate-900 tracking-tight">Gestion des Clients</h1>
            <p class="text-xs text-slate-400 font-medium">Visualisez et gérez les comptes utilisateurs enregistrés</p>
          </div>
          <div class="bg-indigo-50/60 border border-indigo-100 text-indigo-700 text-xs px-4 py-2.5 rounded-xl font-bold tracking-wide shrink-0">
            Total clients actifs : <span class="text-indigo-900 font-black ml-1">{{ $clients->count() }}</span>
          </div>
        </div>

        @if(session('success'))
          <div class="flex items-center gap-2.5 px-4 py-3.5 bg-emerald-50 border border-emerald-200/50 rounded-xl text-xs text-emerald-700 font-bold shadow-sm animate-fadeIn">
            <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
            {{ session('success') }}
          </div>
        @endif

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[800px]">
              <thead class="bg-slate-50/70 border-b border-slate-100/80">
                <tr>
                  <th class="text-left px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[28%]">Client</th>
                  <th class="text-left px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[28%]">Contact / Email</th>
                  <th class="text-left px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[18%]">Téléphone</th>
                  <th class="text-left px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[14%]">Inscription</th>
                  <th class="text-center px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[12%]">Statut</th>
                  <th class="text-right px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider w-[10%]">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
              @forelse($clients as $client)
              <tr class="hover:bg-slate-50/40 smooth-transition group">

                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100/50 text-indigo-600 font-black text-xs uppercase flex items-center justify-center shrink-0">
                        {{ substr($client->firstname, 0, 1) }}{{ substr($client->lastname, 0, 1) }}
                      </div>
                      <div class="min-w-0">
                        <span class="text-slate-900 font-bold block truncate group-hover:text-indigo-600 smooth-transition">
                          {{ $client->firstname }} {{ $client->lastname }}
                        </span>
                      </div>
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold">
                      <i class="far fa-envelope text-slate-400 text-[11px]"></i>
                      <span class="truncate max-w-[180px]">{{ $client->email }}</span>
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-slate-500 font-semibold text-xs">
                    @if($client->phone)
                      <span class="flex items-center gap-1.5 text-slate-600"><i class="fas fa-phone-alt text-[10px] text-slate-400"></i> {{ $client->phone }}</span>
                    @else
                      <span class="text-slate-400 italic text-[11px]">Non renseigné</span>
                    @endif
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-slate-400 text-xs font-bold tracking-tight">
                    {{ $client->created_at->format('d M Y') }}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-center">
                    @if($client->is_active)
                      <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                        Actif
                      </span>
                    @else
                      <span class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg bg-slate-50 text-slate-400 border border-slate-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 inline-block"></span>
                        Inactif
                      </span>
                    @endif
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    @if($client->is_active)
                      <form action="{{ route('admin.clients.desactiver', ['user' => $client->id]) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="text-[11px] font-black uppercase tracking-wide px-3 py-1.5 rounded-xl border smooth-transition shadow-sm active:scale-95 border-rose-100 bg-rose-50/50 text-rose-600 hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200">
                          <i class="fas fa-ban mr-1 text-[10px]"></i> Bloquer
                        </button>
                      </form>
                    @else
                      <form action="{{ route('admin.clients.activer', ['user' => $client->id]) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="text-[11px] font-black uppercase tracking-wide px-3 py-1.5 rounded-xl border smooth-transition shadow-sm active:scale-95 border-emerald-100 bg-emerald-50/50 text-emerald-600 hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200">
                          <i class="fas fa-check mr-1 text-[10px]"></i> Activer
                        </button>
                      </form>
                    @endif
                  </td>

              </tr>
              @empty
              <tr>
                <td colspan="6" class="px-6 py-16 text-center">
                  <div class="max-w-xs mx-auto space-y-3">
                    <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-lg mx-auto border border-slate-100">
                      <i class="fas fa-users-slash"></i>
                    </div>
                    <div class="space-y-0.5">
                      <p class="text-slate-900 font-extrabold text-sm">Aucun client trouvé</p>
                      <p class="text-slate-400 text-xs">La base de données ne contient aucun utilisateur pour le moment.</p>
                    </div>
                  </div>
                </td>
              </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </main>

  </div>

</body>
</html>