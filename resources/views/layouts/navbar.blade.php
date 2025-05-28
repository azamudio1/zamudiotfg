<nav x-data="{ open: false }" class="bg-white/80 dark:bg-gray-900/90 backdrop-blur shadow-md border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo y enlaces principales --}}
            <div class="flex items-center space-x-4">
                <a href="{{ url('/dashboard') }}" class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition">ZamudioShop</a>
                
                <div class="hidden md:flex space-x-4 text-sm font-medium">
                    <a href="{{ url('/cart') }}" class="text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">🛒 Carrito</a>
                    
                    @auth
                        <a href="{{ url('/orders') }}" class="text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition">📦 Mis pedidos</a>
                    @endauth
                </div>
            </div>

            {{-- Botón hamburguesa --}}
            <div class="md:hidden">
                <button @click="open = !open" class="focus:outline-none">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Opciones usuario --}}
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <span class="text-green-600 dark:text-green-400 font-semibold text-sm">Saldo: €{{ number_format(Auth::user()->wallet_balance, 2) }}</span>
                    <a href="{{ route('wallet.show') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Recargar</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="text-sm text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">Iniciar sesión</a>
                    <a href="{{ url('/register') }}" class="text-sm text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">Registrarse</a>
                @endauth
            </div>
        </div>

        {{-- Menú móvil --}}
        <div x-show="open" x-transition class="md:hidden mt-4 space-y-2 text-sm font-medium">
            <a href="{{ url('/cart') }}" class="block text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">🛒 Carrito</a>
            
            @auth
                <a href="{{ url('/orders') }}" class="block text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">📦 Mis pedidos</a>
                <span class="block text-green-600 dark:text-green-400 font-semibold">Saldo: €{{ number_format(Auth::user()->wallet_balance, 2) }}</span>
                <a href="{{ route('wallet.show') }}" class="block text-blue-600 dark:text-blue-400 hover:underline">Recargar</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block text-red-600 dark:text-red-400 hover:underline">Cerrar sesión</button>
                </form>
            @else
                <a href="{{ url('/login') }}" class="block text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">Iniciar sesión</a>
                <a href="{{ url('/register') }}" class="block text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
