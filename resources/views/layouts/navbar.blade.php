<nav class="bg-gray-800 text-white p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 sm:gap-0">
    <div>
        <a href="{{ url('/') }}" class="text-lg font-bold">{{ __('messages.welcome') }}</a>
    </div>

    <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4">
        <a href="{{ url('/cart') }}">{{ __('messages.cart') }}</a>
        <a href="{{ url('/checkout') }}">{{ __('messages.checkout') }}</a>

        @auth
            <a href="{{ url('/orders') }}">{{ __('messages.order_history') }}</a>

            {{-- Mostrar saldo --}}
            <span class="text-green-400 font-semibold">
                Saldo: €{{ number_format(Auth::user()->wallet_balance, 2) }}
            </span>

            {{-- Botón para recargar saldo --}}
            <a href="{{ route('wallet.show') }}" class="text-blue-400 hover:underline">
                Recargar saldo
            </a>

            <a href="{{ url('/logout') }}">{{ __('messages.logout') }}</a>
        @else
            <a href="{{ url('/login') }}">{{ __('messages.login') }}</a>
        @endauth
    </div>

    <div>
        <a href="{{ url('lang/en') }}" class="mr-2">🇬🇧 English</a>
        <a href="{{ url('lang/es') }}">🇪🇸 Español</a>
    </div>
</nav>
