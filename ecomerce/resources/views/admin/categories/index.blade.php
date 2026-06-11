<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen">

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
                        <a href="#" class="text-indigo-600 border-b-2 border-indigo-600 py-5">Categories</a>
                        <a href="{{ route('orders') }}" class="text-slate-400 hover:text-slate-900 transition-colors">Orders</a>
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

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="space-y-1">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                    <span class="p-2.5 bg-indigo-600 text-white rounded-2xl shadow-md shadow-indigo-600/10 flex items-center justify-center">
                        <i class="fas fa-tags text-xl"></i>
                    </span>
                    Gestion des Catégories
                </h1>
                <p class="text-sm text-slate-500 font-medium pl-1">Gerez vos catégories de produits, descriptions et inventaires.</p>
            </div>
        </div>

        {{-- Success Feedback --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl mb-6 shadow-sm">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error Feedback --}}
        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl mb-6 shadow-sm">
                <i class="fas fa-exclamation-circle text-rose-500 text-lg"></i>
                <span class="text-sm font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8 items-start">
            
            <div class="bg-white rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(148,163,184,0.08)] p-6 group transition-all duration-300 hover:shadow-md">
                <h2 class="text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                    <i class="fas fa-plus text-indigo-500 text-sm"></i>
                    Ajouter une catégorie
                </h2>

                <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1.5 text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Nom de la catégorie <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400 pointer-events-none">
                                <i class="fas fa-heading text-xs"></i>
                            </span>
                            <input
                                type="text"
                                name="name"
                                class="w-full pl-9 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm"
                                placeholder="Ex: PC Gaming, Smartwatches..."
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-xs font-bold text-slate-700 uppercase tracking-wider">
                            Description
                        </label>
                        <div class="relative">
                            <span class="absolute top-3 left-3.5 text-slate-400 pointer-events-none">
                                <i class="fas fa-align-left text-xs"></i>
                            </span>
                            <textarea
                                name="description"
                                rows="4"
                                class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm"
                                placeholder="Ajoutez des détails sur la catégorie..."
                            ></textarea>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition-all shadow-md shadow-indigo-600/10 hover:shadow-lg active:scale-[0.99]"
                    >
                        <i class="fas fa-paper-plane text-xs"></i> Enregistrer
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-[0_10px_30px_rgba(148,163,184,0.08)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-slate-500">
                                <th class="p-4 pl-6 text-xs font-bold uppercase tracking-wider w-16">ID</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider">Nom</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider hidden sm:table-cell">Description</th>
                                <th class="p-4 text-xs font-bold uppercase tracking-wider text-center">Produits</th>
                                <th class="p-4 pr-6 text-xs font-bold uppercase tracking-wider text-center w-36">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/50 transition-colors group/tr">
                                <td class="p-4 pl-6 text-sm font-semibold text-slate-400">
                                    #{{ $category->id }}
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-900 group-hover/tr:text-indigo-600 transition-colors">
                                        {{ $category->name }}
                                    </div>
                                    <div class="text-xs text-slate-400 font-normal sm:hidden mt-0.5 truncate max-w-[150px]">
                                        {{ $category->description ?? 'Aucune description' }}
                                    </div>
                                </td>
                                <td class="p-4 text-sm font-medium text-slate-500 hidden sm:table-cell max-w-xs truncate">
                                    {{ $category->description ?? '—' }}
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-black bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-lg min-w-[32px]">
                                        {{ $category->products_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="p-4 pr-6">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <button 
                                            type="button"
                                            onclick="openEditModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description) }}')"
                                            class="p-2 text-amber-600 hover:bg-amber-50 rounded-xl border border-transparent hover:border-amber-200 transition-all text-xs font-bold flex items-center gap-1"
                                            title="Modifier"
                                        >
                                            <i class="fas fa-edit"></i> <span class="hidden md:inline">Edit</span>
                                        </button>

                                        <form
                                            action="{{ route('categories.destroy', $category) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer la catégorie {{ $category->name }} ?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl border border-transparent hover:border-rose-200 transition-all text-xs font-bold flex items-center gap-1"
                                                title="Supprimer"
                                            >
                                                <i class="fas fa-trash-alt"></i> <span class="hidden md:inline">Delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="fas fa-box-open text-3xl text-slate-300"></i>
                                        <span class="text-sm font-semibold">Aucune catégorie trouvée</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

                @if($categories->hasPages())
                    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div id="editCategoryModal" class="fixed inset-0 z-50 invisible opacity-0 flex items-center justify-center p-4 transition-all duration-300">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
        
        <div class="bg-white w-full max-w-md rounded-3xl p-6 shadow-2xl relative z-10 transform scale-95 transition-all duration-300" id="modalBox">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="fas fa-edit text-amber-500"></i> Modifier la catégorie
                </h3>
                <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <form id="editCategoryForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1.5 text-xs font-bold text-slate-700 uppercase tracking-wider">Nom de la catégorie</label>
                    <input
                        type="text"
                        id="modal_name"
                        name="name"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm"
                        required
                    >
                </div>

                <div>
                    <label class="block mb-1.5 text-xs font-bold text-slate-700 uppercase tracking-wider">Description</label>
                    <textarea
                        id="modal_description"
                        name="description"
                        rows="3"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm"
                    ></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button 
                        type="button" 
                        onclick="closeEditModal()" 
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs uppercase tracking-wider transition-colors"
                    >
                        Annuler
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-colors shadow-md shadow-indigo-600/10"
                    >
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, description) {
            const modal = document.getElementById('editCategoryModal');
            const box = document.getElementById('modalBox');
            const form = document.getElementById('editCategoryForm');
            
            document.getElementById('modal_name').value = name;
            document.getElementById('modal_description').value = description;
            
            form.action = `/categories/${id}`; 

            modal.classList.remove('invisible', 'opacity-0');
            modal.classList.add('visible', 'opacity-100');
            box.classList.remove('scale-95');
            box.classList.add('scale-100');
        }

        function closeEditModal() {
            const modal = document.getElementById('editCategoryModal');
            const box = document.getElementById('modalBox');

            modal.classList.remove('visible', 'opacity-100');
            modal.classList.add('invisible', 'opacity-0');
            box.classList.remove('scale-100');
            box.classList.add('scale-95');
        }
    </script>

</body>
</html>