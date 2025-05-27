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
            background: radial-gradient(circle at 20% 40%, rgba(255, 255, 255, 0.05), transparent 70%),
                        radial-gradient(circle at 80% 60%, rgba(255, 255, 255, 0.03), transparent 70%);
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white min-h-screen font-sans">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Contenido Principal --}}
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- Footer Profesional --}}
    <footer class="bg-gray-950 text-gray-400 text-sm mt-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white font-bold text-lg mb-2">Sobre Nosotros</h3>
                <p>Ofrecemos los mejores productos a los mejores precios, con una experiencia de compra moderna y segura.</p>
            </div>
            <div>
                <h3 class="text-white font-bold text-lg mb-2">Enlaces Rápidos</h3>
                <ul class="space-y-1">
                    <li><a href="#" class="hover:text-white">Inicio</a></li>
                    <li><a href="#" class="hover:text-white">Productos</a></li>
                    <li><a href="#" class="hover:text-white">Mi Cuenta</a></li>
                    <li><a href="#" class="hover:text-white">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-bold text-lg mb-2">Suscríbete</h3>
                <form action="#" class="flex flex-col sm:flex-row gap-2">
                    <input type="email" placeholder="Tu correo" class="w-full px-4 py-2 rounded bg-gray-800 text-white placeholder-gray-400 focus:outline-none">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white">Enviar</button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-800 text-center py-4 text-xs">
            &copy; {{ date('Y') }} TuTienda. Todos los derechos reservados.
        </div>
    </footer>

</body>
</html>
