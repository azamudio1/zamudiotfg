<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">Historial de pedidos</h1>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        @forelse ($orders as $order)
            <div class="bg-white shadow-md rounded p-4 mb-6">
                <h2 class="text-lg font-semibold mb-2">Pedido #{{ $order->id }}</h2>
                <p class="text-sm text-gray-600">Estado: <span class="font-medium">{{ ucfirst($order->status) }}</span></p>
                <p class="text-sm text-gray-600">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-sm text-gray-600 mb-2">Total pagado: <strong>{{ number_format($order->total, 2) }}€</strong></p>

                <table class="w-full table-auto text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 text-left">Producto</th>
                            <th class="p-2 text-left">Variante</th>
                            <th class="p-2 text-right">Cantidad</th>
                            <th class="p-2 text-right">Precio</th>
                            <th class="p-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-t">
                                <td class="p-2">{{ $item->product->name ?? 'Producto eliminado' }}</td>
                                <td class="p-2">{{ $item->variant->name ?? 'N/A' }}</td>
                                <td class="p-2 text-right">{{ $item->quantity }}</td>
                                <td class="p-2 text-right">{{ number_format($item->price, 2) }}€</td>
                                <td class="p-2 text-right">{{ number_format($item->price * $item->quantity, 2) }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <p>No tienes pedidos realizados todavía.</p>
        @endforelse
    </div>
</x-app-layout>
