<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande confirmée — MyShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { background-color: #020617; }</style>
</head>
<body class="text-slate-300 antialiased font-sans min-h-screen flex items-center justify-center">

<div class="text-center space-y-5 max-w-md mx-auto p-6">
    <div class="text-6xl">🎉</div>
    <h1 class="text-3xl font-black text-white uppercase italic">Commande confirmée !</h1>
    <p class="text-slate-400 text-sm">Merci pour votre achat. Vous serez livré très bientôt.</p>
    <a href="{{ route('products.index') }}"
        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-black px-8 py-3 rounded-2xl uppercase text-sm tracking-wider transition">
        Continuer les achats →
    </a>
</div>

</body>
</html>