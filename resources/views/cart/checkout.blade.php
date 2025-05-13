<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Finalizar Compra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 text-red-600 font-semibold">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(count($cart) > 0)
                    <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Resumen del Carrito</h3>

                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <li class="flex items-center py-4">
                                <img src="{{ $item['image'] }}" class="w-16 h-16 rounded mr-4 object-cover">
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-lg text-gray-800 dark:text-white">{{ $item['name'] }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $item['description'] }}</p>
                                    <p class="text-sm mt-1 text-gray-600 dark:text-gray-300">Cantidad: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="text-right font-bold text-lg text-gray-800 dark:text-white">
                                    €{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Formulario de cupón --}}
                    <div class="mt-6">
                        <form action="{{ route('cart.applyCoupon') }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Código de cupón"
                                   class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white px-4 py-2 w-full sm:w-1/2">
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                Aplicar cupón
                            </button>
                        </form>
                    </div>

                    <form action="{{ route('cart.processCheckout') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección de envío</label>
                        <input type="text" name="shipping_address" id="shipping_address" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- Botón de pagar y demás contenido -->
                </form>

                    {{-- Resumen del carrito


                    {{-- Descuento y total --}}
                    @php
                        $discount = 0;
                        if (session('applied_coupon')) {
                            $coupon = session('applied_coupon');
                            if ($coupon->type === 'percentage') {
                                $discount = $total * ($coupon->discount / 100);
                            } else {
                                $discount = $coupon->discount;
                            }
                            $discount = min($discount, $total);
                        }
                        $totalWithDiscount = $total - $discount;
                    @endphp

                    <div class="mt-6 text-right text-gray-800 dark:text-white">
                        @if(session('applied_coupon'))
                            <p class="text-md">Cupón aplicado: <strong>{{ $coupon->code }}</strong></p>
                            <p class="text-md">Descuento: <strong>-{{ number_format($discount, 2) }}€</strong></p>
                            <h4 class="text-xl font-bold mt-2">Total con descuento: {{ number_format($totalWithDiscount, 2) }}€</h4>
                        @else
                            <h4 class="text-xl font-bold">Total: {{ number_format($total, 2) }}€</h4>
                        @endif
                    </div>

                    {{-- Botón de pago --}}
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="mt-6 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-lg">
                            Pagar ahora
                        </button>
                    </form>
                @else
                    <p class="text-gray-600 dark:text-gray-300">Tu carrito está vacío.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
