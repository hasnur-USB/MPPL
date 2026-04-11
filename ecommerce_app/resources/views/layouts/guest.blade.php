<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TokoKita - Authentication</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="font-sans antialiased bg-[#fcfcfd]">
    <div class="min-h-screen flex flex-col justify-center items-center p-6">
        
        <div class="mb-10">
            <a href="/" class="text-2xl font-extrabold tracking-tight text-gray-900 flex items-center gap-2">
                <span class="bg-blue-600 text-white p-2 rounded-lg">TK</span>
                TokoKita
            </a>
        </div>

        <div class="w-full sm:max-w-[440px] bg-white border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-[24px] overflow-hidden">
            <div class="p-10">
                {{ $slot }}
            </div>
        </div>

        <div class="mt-10 text-center">
            <p class="text-gray-400 text-[11px] tracking-[0.2em] uppercase font-bold mb-2">
                &copy; {{ date('Y') }} TokoKita Indonesia
            </p>
            <p class="text-gray-400 text-sm italic">
                Dibuat denagan <span class="text-red-400">❤️</span> dan sedikit kopi.
            </p>
        </div>
        
    </div>
</body>
</html>