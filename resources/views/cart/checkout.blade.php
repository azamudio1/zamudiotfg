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

                @if(count($cart) > 0)
                    <h3 class="text-xl font-bold mb-4">Resumen del Carrito</h3>
                    
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @php $total = 0; @endphp
                        @foreach($cart as $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <li class="flex items-center py-4">
                                <img src="{{ $item['image'] }}" class="w-16 h-16 rounded mr-4 object-cover">
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-lg">{{ $item['name'] }}</h4>
                                    <p class="text-sm">{{ $item['description'] }}</p>
                                    <p class="text-sm mt-1">Cantidad: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="text-right font-bold text-lg">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-6 text-right">
                        <h4 class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</h4>

                        {{-- Botón de pago (futuro PayPal) --}}
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                Pagar con PayPal
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-300">Tu carrito está vacío.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
