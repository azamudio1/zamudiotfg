<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Pedido #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #6366f1;
            padding-bottom: 10px;
            margin-bottom: 40px;
        }

        .brand {
            font-size: 28px;
            font-weight: bold;
            color: #6366f1;
            text-decoration: none;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f3f4f6;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        .small {
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="{{ url('/dashboard') }}" class="brand">ZamudioShop</a>
        <div class="small">
            Pedido #{{ $order->id }}<br>
            Fecha: {{ $order->created_at->format('d/m/Y H:i') }}
        </div>
    </div>

    <div class="section">
        <div class="title">Factura</div>
        <div><strong>Cliente:</strong> {{ $order->user->name }} ({{ $order->user->email }})</div>
        <div><strong>Dirección de envío:</strong> {{ $order->shipping_address ?? 'No especificada' }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Producto eliminado' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} €</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total pagado: {{ number_format($order->total, 2) }} €
    </div>

    <div class="small" style="margin-top: 40px;">
        Gracias por tu compra en <strong>ZamudioShop</strong>. 
    </div>

</body>
</html>
