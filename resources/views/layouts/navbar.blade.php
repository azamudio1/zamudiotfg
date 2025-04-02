<nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <div>
        <a href="{{ url('/') }}" class="text-lg font-bold">{{ __('messages.welcome') }}</a>
    </div>
    <div>
        <a href="{{ url('/cart') }}" class="mr-4">{{ __('messages.cart') }}</a>
        <a href="{{ url('/checkout') }}" class="mr-4">{{ __('messages.checkout') }}</a>
        @auth
            <a href="{{ url('/orders') }}" class="mr-4">{{ __('messages.order_history') }}</a>
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
