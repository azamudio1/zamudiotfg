<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Carbon;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
{
    $cart = session()->get('cart', []);

    $image = $product->images()->first(); // Obtener la primera imagen del producto
    $imageUrl = $image ? asset('storage/' . $image->image_path) : 'https://via.placeholder.com/150';

    $cart[$product->id] = [
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + 1 : 1,
        'image' => $imageUrl, // Guardar la URL de la imagen
    ];

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Producto añadido al carrito.');
}

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $quantity = max(1, intval($request->quantity));
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('cart.checkout', compact('cart'));
    }
    public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string',
    ]);

    $coupon = Coupon::where('code', $request->coupon_code)->first();


    if (!$coupon) {
        return redirect()->back()->withErrors(['coupon_code' => 'Cupón inválido o caducado.']);
    }

    session(['applied_coupon' => $coupon]);
    return redirect()->back()->with('success', 'Cupón aplicado correctamente.');
}
    
}
