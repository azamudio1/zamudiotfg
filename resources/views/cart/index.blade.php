<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                            @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 text-red-600 font-semibold">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Mensajes de sesión --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                @auth
                    <div class="mb-4 text-right text-gray-700 dark:text-gray-300">
                        Saldo en cartera: <strong>{{ Auth::user()->wallet_balance }}€</strong>
                    </div>
                @endauth

                @if(session('cart') && count(session('cart')) > 0)
                    <div class="space-y-6">
                        @php
                            $total = 0;
                            $discount = 0;
                        @endphp

                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp

                            <div class="flex flex-col sm:flex-row items-center justify-between border-b pb-4 gap-4">
                                <div class="flex items-center gap-4 w-full sm:w-auto">
                                    @if (!empty($details['image']))
                                        <img src="{{ $details['image'] }}"
                                             alt="{{ $details['name'] }}"
                                             class="w-24 h-24 object-cover rounded border">
                                    @else
                                        <div class="w-24 h-24 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500 rounded border">
                                            Sin imagen
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $details['name'] }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $details['description'] ?? '' }}</p>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">
                                            Precio unitario: <strong>{{ $details['price'] }}€</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row items-center gap-4">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1"
                                               class="w-16 text-center rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white" />
                                        <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                            Actualizar
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        {{-- Formulario de cupón --}}
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="mt-6 flex gap-4 items-center">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Código de cupón"
                                   class="rounded px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                                   value="{{ old('coupon_code') }}">
                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                                Aplicar cupón
                            </button>
                        </form>

                        {{-- Mostrar descuento si hay cupón --}}
                        @if(session('applied_coupon'))
                            @php
                                $coupon = session('applied_coupon');
                                if ($coupon->type === 'percentage') {
                                    $discount = $total * ($coupon->discount / 100);
                                } else {
                                    $discount = $coupon->discount;
                                }
                                $discount = min($discount, $total); // evitar que el total sea negativo
                            @endphp

                            <div class="mt-6 text-right text-gray-800 dark:text-white">
                                <p class="text-md">Cupón aplicado: <strong>{{ $coupon->code }}</strong></p>
                                <p class="text-md">Descuento: <strong>-{{ number_format($discount, 2) }}€</strong></p>
                                <p class="text-xl font-bold mt-2">Total con descuento: {{ number_format($total - $discount, 2) }}€</p>
                            </div>
                        @else
                            <div class="text-right mt-6">
                                <p class="text-xl font-bold text-gray-800 dark:text-white">Total: {{ number_format($total, 2) }}€</p>
                            </div>
                        @endif

                        <div class="flex justify-end mt-6">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg text-lg hover:bg-green-700">
                                Pagar con cartera virtual
                            </button>
                        </form>

                        </div>
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300">Tu carrito está vacío.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
