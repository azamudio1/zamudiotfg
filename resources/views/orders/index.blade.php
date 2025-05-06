<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Historial de Pedidos
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if ($orders->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">No tienes pedidos aún.</p>
            @else
                @foreach ($orders as $order)
                    <div class="mb-4 border-b border-gray-300 pb-4">
                        <p class="font-bold text-gray-900 dark:text-white">Pedido #{{ $order->id }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Total: {{ $order->total }} €</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Estado: {{ ucfirst($order->status) }}</p>

                        <ul class="mt-2 text-sm text-gray-700 dark:text-gray-300 list-disc list-inside">
                            @foreach ($order->items as $item)
                                <li>{{ $item->name }} x{{ $item->quantity }} - {{ $item->price }} €</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
