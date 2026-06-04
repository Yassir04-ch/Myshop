<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MyShop - Admin Clients</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-600 antialiased min-h-screen flex flex-col">

  <header class="w-full h-16 bg-white border-b border-slate-100 fixed top-0 z-50 flex items-center justify-between px-6">
    <div class="flex items-center gap-2.5">
      <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-md shadow-indigo-200">
        <i class="fas fa-microchip text-sm"></i>
      </div>
      <span class="text-lg font-black text-slate-800 tracking-tight">My<span class="text-indigo-600">Shop</span></span>
    </div>

    <div class="flex items-center gap-4">
      <button class="relative w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:text-indigo-600 hover:bg-slate-50 transition-all duration-200">
        <i class="far fa-bell text-lg"></i>
        <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-indigo-600 ring-2 ring-white animate-pulse"></span>
      </button>

      <div class="h-6 w-[1px] bg-slate-100"></div>

      <div class="flex items-center gap-2.5 cursor-pointer group">
        <div class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-700 font-bold text-xs uppercase group-hover:border-indigo-200 transition-colors">
          AD
        </div>
        <div class="hidden sm:block text-left">
          <p class="text-xs font-semibold text-slate-800 leading-none">Admin</p>
          <p class="text-[10px] text-slate-400 mt-0.5">Propriétaire</p>
        </div>
        <i class="fas fa-chevron-down text-[10px] text-slate-400 group-hover:text-slate-600 transition-colors ml-1"></i>
      </div>
    </div>
  </header>

  <div class="flex flex-1 pt-16">
    
    <aside class="w-64 bg-slate-900 text-slate-400 fixed top-16 bottom-0 left-0 z-40 hidden md:flex flex-col justify-between p-4 border-r border-slate-800/40">
      <div class="space-y-7 mt-2">
        <div>
          <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-3">Menu Principal</p>
          <nav class="space-y-1">
            <a href="{{route('dashboard')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 hover:text-white hover:bg-slate-800/50">
              <i class="fas fa-chart-pie text-base w-5"></i>
              Dashboard
            </a>
            <a href="{{route('productsadmin')}}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 hover:text-white hover:bg-slate-800/50">
              <i class="fas fa-box text-base w-5"></i>
              Produits
            </a>
            <a href="" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-200 hover:text-white hover:bg-slate-800/50">
              <i class="fas fa-shopping-bag text-base w-5"></i>
              Commandes
            </a>
            <a href="" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 text-white shadow-lg shadow-indigo-600/10 transition-all duration-200">
              <i class="fas fa-users text-base w-5"></i>
              Clients
            </a>
          </nav>
        </div>
      </div>

      <div class="border-t border-slate-800 pt-4 mb-2">
        <a href="{{route('logout')}}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-semibold text-slate-500 hover:text-red-400 transition-colors">
          <i class="fas fa-sign-out-alt text-base w-5"></i>
          Déconnexion
        </a>
      </div>
    </aside>

    <main class="flex-1 md:ml-64 p-6 sm:p-10">
      <div class="max-w-5xl mx-auto space-y-6">

        <!-- HEADER SECTION -->
        <div class="flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
          <div>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">Clients</h1>
            <p class="text-xs text-slate-400 mt-0.5">Liste des utilisateurs avec le rôle client</p>
          </div>
          <div class="bg-indigo-50/50 border border-indigo-100 text-indigo-700 text-xs px-4 py-2.5 rounded-xl font-medium">
            Total clients : <strong class="text-indigo-900 font-bold ml-1">{{ $clients->count() }}</strong>
          </div>
        </div>

        @if(session('success'))
          <div class="flex items-center gap-2.5 px-4 py-3 bg-emerald-50 border border-emerald-200/60 rounded-xl text-xs text-emerald-700 font-medium shadow-sm">
            <svg class="w-4 h-4 shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
          </div>
        @endif

        <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[700px]">
              <thead class="bg-slate-50/70 border-b border-slate-100">
                <tr>
                  <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[30%]">Nom</th>
                  <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[30%]">Email</th>
                  <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[18%]">phone</th>
                  <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[18%]">Inscrit le</th>
                  <th class="text-center px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[12%]">Statut</th>
                  <th class="text-right px-6 py-3.5 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-[10%]">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
              @forelse($clients as $client)
              <tr class="hover:bg-slate-50/50 transition-colors group">

                  <td class="px-6 py-4 text-slate-500 font-medium truncate">
                      {{ $client->firstname }} {{ $client->lastname }}
                  </td>

                  <td class="px-6 py-4 text-slate-500 font-medium truncate">
                      {{ $client->email }}
                  </td>

                  <td class="px-6 py-4 text-slate-500 font-medium truncate">
                      {{ $client->phone }}
                  </td>

                  <td class="px-6 py-4 text-slate-400 text-xs font-medium">
                      {{ $client->created_at->format('d M Y') }}
                  </td>

                  <td class="px-6 py-4 text-center">

                      @if($client->is_active)

                      <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100">
                          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                          Actif
                      </span>

                      @else

                      <span class="inline-flex items-center gap-1.5 text-[11px] font-bold px-2.5 py-1 rounded-lg bg-slate-100 text-slate-400 border border-slate-200/40">
                          <span class="w-1.5 h-1.5 rounded-full bg-slate-400 inline-block"></span>
                          Inactif
                      </span>

                      @endif

                  </td>

                  <td class="px-6 py-4 text-right">

                      @if($client->is_active)

                      <form action="{{ route('admin.clients.desactiver', ['user' => $client->id]) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <button type="submit"
                              class="text-xs font-bold px-3 py-1.5 rounded-xl border tracking-wide transition-all duration-200 shadow-sm active:scale-95 border-red-100 bg-red-50/50 text-red-500 hover:bg-red-50 hover:border-red-200">

                              Désactiver

                          </button>
                      </form>

                      @else

                      <form action="{{ route('admin.clients.activer', ['user' => $client->id]) }}" method="POST">
                          @csrf
                          @method('PUT')

                          <button type="submit"
                              class="text-xs font-bold px-3 py-1.5 rounded-xl border tracking-wide transition-all duration-200 shadow-sm active:scale-95 border-emerald-100 bg-emerald-50/50 text-emerald-600 hover:bg-emerald-50 hover:border-emerald-200">

                              Activer

                          </button>
                      </form>

                      @endif

                  </td>

              </tr>

              @empty

              <tr>
                  <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                      Aucun client trouvé
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