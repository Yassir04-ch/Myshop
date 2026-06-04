<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MyShop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 min-h-screen">
        {{-- Hna hyadna l-box mdiyqa d breeze o raddinah container kbir flex flex-col --}}
        <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 md:p-12 relative overflow-hidden bg-[radial-gradient(at_top_right,_var(--tw-gradient-stops))] from-indigo-50/40 via-slate-50 to-slate-50">
            
            {{-- Slot hna ghadi tkhrej fiha l-view dyal register kamla b l-wsa3eyya dyalha --}}
            <div class="w-full max-w-4xl">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>