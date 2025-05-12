<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la Tienda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 min-h-screen flex items-center justify-center">
    <div class="text-white text-center px-4">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 drop-shadow-lg animate-fade-in-down">
            Bienvenido a la tienda online 🛒
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto animate-fade-in-up">
            Compra productos exclusivos, recibe ofertas personalizadas y gestiona tus pedidos fácilmente desde tu cuenta.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up">
            <a href="{{ route('login') }}"
               class="bg-white text-purple-600 font-semibold py-3 px-6 rounded-xl hover:bg-purple-100 shadow-lg transition duration-300">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}"
               class="bg-purple-800 text-white font-semibold py-3 px-6 rounded-xl hover:bg-purple-700 shadow-lg transition duration-300">
                Registrarse
            </a>
        </div>
        <div class="mt-10 animate-fade-in-up">
            <a href="#" class="text-white underline hover:text-gray-100 text-sm">Saber más sobre nosotros</a>
        </div>
    </div>

    <!-- Animaciones (opcional con Tailwind plugin o clases propias) -->
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
            animation: fade-in-down 1s ease-out;
        }
        .animate-fade-in-up {
            animation: fade-in-up 1.2s ease-out;
        }
    </style>
</body>
</html>
