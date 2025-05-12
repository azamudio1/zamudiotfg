@extends('layouts.app')

@section('content')
    <div class="py-16">
        <div class="max-w-6xl mx-auto px-6 lg:px-8 space-y-12">

            <h1 class="text-5xl font-extrabold text-white mb-10 text-center">📦 Historial de Pedidos</h1>

            @forelse ($orders as $order)
                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl p-6 space-y-4 hover:shadow-2xl transition">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">🧾 Pedido #{{ $order->id }}</h2>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-2 sm:mt-0">
                            Estado: <span class="font-semibold">{{ ucfirst($order->status) }}</span> |
                            Fecha: {{ $order->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">Total pagado: {{ number_format($order->total, 2) }}€</p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm table-auto border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3 text-left">Producto</th>
                                    <th class="px-4 py-3 text-left">Variante</th>
                                    <th class="px-4 py-3 text-right">Cantidad</th>
                                    <th class="px-4 py-3 text-right">Precio</th>
                                    <th class="px-4 py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3 text-gray-800 dark:text-white">
                                            {{ $item->product->name ?? 'Producto eliminado' }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $item->variant->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-right text-gray-800 dark:text-white">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-4 py-3 text-right text-gray-800 dark:text-white">
                                            {{ number_format($item->price, 2) }}€
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold text-emerald-600 dark:text-emerald-400">
                                            {{ number_format($item->price * $item->quantity, 2) }}€
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 dark:text-gray-400 text-lg">
                    No tienes pedidos realizados todavía.
                </div>
            @endforelse

        </div>
    </div>
@endsection
