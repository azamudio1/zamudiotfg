<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function userOrders()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'No autorizado');
        }

        $orders = Order::with(['items.product', 'items.variant'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
        ]);

        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    public function show($id)
    {
        return response()->json(Order::with('items')->find($id));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $order->update($request->all());

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Pedido eliminado'], 200);
    }
    

    public function downloadInvoice(Order $order)
    {

        $pdf = Pdf::loadView('orders.invoice', ['order' => $order]);
        return $pdf->download("Factura-Pedido-{$order->id}.pdf");
    }

}
