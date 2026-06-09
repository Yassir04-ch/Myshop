<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Gestion des Catégories
        </h1>
    </div>

    {{-- Success --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Create Category --}}
    <div class="bg-white rounded-2xl shadow p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">
            Ajouter une catégorie
        </h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Nom
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="w-full border rounded-xl p-3"
                        placeholder="Nom catégorie"
                        required
                    >
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium">
                        Description
                    </label>

                    <input
                        type="text"
                        name="description"
                        class="w-full border rounded-xl p-3"
                        placeholder="Description"
                    >
                </div>

            </div>

            <button
                type="submit"
                class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl"
            >
                Ajouter
            </button>

        </form>
    </div>

    {{-- Categories Table --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-200">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Description</th>
                    <th class="p-4 text-center">Produits</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">
                        {{ $category->id }}
                    </td>

                    <td class="p-4 font-semibold">
                        {{ $category->name }}
                    </td>

                    <td class="p-4">
                        {{ $category->description }}
                    </td>

                    <td class="p-4 text-center">
                        {{ $category->products_count }}
                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-2">

                            {{-- Update --}}
                            <form
                                action="{{ route('categories.update',$category) }}"
                                method="POST"
                                class="flex gap-2"
                            >
                                @csrf
                                @method('PUT')

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ $category->name }}"
                                    class="border rounded px-2 py-1"
                                >

                                <button
                                    class="bg-yellow-500 text-white px-3 rounded"
                                >
                                    Update
                                </button>

                            </form>

                            {{-- Delete --}}
                            <form
                                action="{{ route('categories.destroy',$category) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Supprimer cette catégorie ?')"
                                    class="bg-red-600 text-white px-3 py-2 rounded"
                                >
                                    Delete
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="p-8 text-center text-slate-500">
                        Aucune catégorie trouvée
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>

</div>

</body>
</html>