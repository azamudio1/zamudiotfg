@extends('layouts.app')

@section('content')
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <h2 class="text-5xl font-extrabold text-white mb-10">🛒 Tu Carrito de Compras</h2>

            {{-- Mensajes de sesión --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 shadow">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-6 shadow">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-6 shadow">
                    {{ $errors->first() }}
                </div>
            @endif

            @auth
                <div class="text-right text-white text-lg font-medium mb-6">
                    Saldo en cartera: <span class="font-bold">{{ Auth::user()->wallet_balance }}€</span>
                </div>
            @endauth

            @if(session('cart') && count(session('cart')) > 0)
                @php $total = 0; $discount = 0; @endphp

                <div class="space-y-8">
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp

                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-6">
                                @if (!empty($details['image']))
                                    <img src="{{ $details['image'] }}" class="w-28 h-28 object-cover rounded-xl border" alt="{{ $details['name'] }}">
                                @else
                                    <div class="w-28 h-28 bg-gray-200 dark:bg-gray-700 rounded-xl flex items-center justify-center text-gray-500">Sin imagen</div>
                                @endif

                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $details['name'] }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $details['description'] ?? '' }}</p>
                                    <p class="text-gray-700 dark:text-gray-300 mt-2">Precio unitario: <strong>{{ $details['price'] }}€</strong></p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                        class="w-16 rounded-lg border border-gray-300 text-center text-gray-800" />
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-lg text-sm shadow">
                                        Actualizar
                                    </button>
                                </form>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg text-sm shadow">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    {{-- Cupón --}}
                    <form action="{{ route('cart.applyCoupon') }}" method="POST" class="flex gap-4 items-center mt-6">
                        @csrf
                        <input type="text" name="coupon_code" placeholder="Código de cupón"
                            class="rounded-lg px-4 py-2 border border-gray-300 w-full md:w-1/3 text-gray-800 bg-white placeholder-gray-500" />
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl shadow">
                            Aplicar cupón
                        </button>
                    </form>

                    {{-- Descuento --}}
                    @if(session('applied_coupon'))
                        @php
                            $coupon = session('applied_coupon');
                            $discount = $coupon->type === 'percentage'
                                ? $total * ($coupon->discount / 100)
                                : $coupon->discount;
                            $discount = min($discount, $total);
                        @endphp

                        <div class="text-right mt-6 text-white space-y-1">
                            <p class="text-lg">Cupón aplicado: <strong>{{ $coupon->code }}</strong></p>
                            <p class="text-lg">Descuento: <strong>-{{ number_format($discount, 2) }}€</strong></p>
                            <p class="text-3xl font-bold mt-2">Total con descuento: {{ number_format($total - $discount, 2) }}€</p>
                        </div>
                    @else
                        <div class="text-right mt-6">
                            <p class="text-3xl font-bold text-white">Total: {{ number_format($total, 2) }}€</p>
                        </div>
                    @endif

                    <div class="flex justify-end mt-10">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-lg px-6 py-3 rounded-2xl shadow-xl">
                                💳 Pagar con cartera virtual
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-white text-lg">Tu carrito está vacío.</p>
            @endif

        </div>
    </div>
@endsection