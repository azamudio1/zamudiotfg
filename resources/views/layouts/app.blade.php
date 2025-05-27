<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tienda')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background: radial-gradient(circle at 25% 35%, rgba(255, 255, 255, 0.02), transparent 60%),
                        radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.01), transparent 60%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 text-white min-h-screen font-sans antialiased tracking-wide">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Contenido Principal --}}
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-10 min-h-[calc(100vh-150px)]">
        @yield('content')
    </main>

    {{-- Footer Profesional --}}
    <footer class="bg-gray-950 border-t border-gray-800 text-gray-500 text-sm">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <span class="text-gray-400">&copy; {{ date('Y') }} TuTienda. Todos los derechos reservados.</span>
            </div>
            <div class="flex space-x-4 text-xs">
                <a href="#" class="hover:text-white transition">Términos</a>
                <a href="#" class="hover:text-white transition">Privacidad</a>
                <a href="#" class="hover:text-white transition">Contacto</a>
            </div>
        </div>
    </footer>

</body>
</html>
