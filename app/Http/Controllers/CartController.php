<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Almacenar artículo en el carrito
    public function store(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = $cart->cartItems()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($cartItem, 201);
    }

    // Obtener el carrito de un usuario
    public function show($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return response()->json(['message' => 'No hay carrito'], 404);
        }

        return response()->json($cart->cartItems);
    }

    // Eliminar carritos abandonados (tarea programada)
    public function cleanAbandonedCarts()
    {
        $cartExpirationTime = now()->subHours(24); // Carritos abandonados después de 24 horas

        Cart::where('updated_at', '<', $cartExpirationTime)->delete();

        return response()->json(['message' => 'Carritos abandonados limpiados'], 200);
    }
}


