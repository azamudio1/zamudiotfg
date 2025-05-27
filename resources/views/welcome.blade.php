<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la Tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.9s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 1.1s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 text-white min-h-screen flex items-center justify-center">

    <div class="relative w-full max-w-4xl px-6 text-center">
        <div class="mb-10 animate-fade-in-down">
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white drop-shadow-xl">
                Bienvenido a ZamudioShop 🛍️
            </h1>
            <p class="mt-4 text-lg text-gray-300 max-w-2xl mx-auto">
                Descubre productos únicos, gestiona tus pedidos y disfruta de una experiencia de compra inmejorable.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up">
            <a href="{{ route('login') }}"
               class="bg-white text-gray-900 font-medium py-3 px-6 rounded-xl shadow-md hover:bg-gray-100 transition duration-300">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-xl shadow-md transition duration-300">
                Crear Cuenta
            </a>
        </div>
    </div>

</body>
</html>
