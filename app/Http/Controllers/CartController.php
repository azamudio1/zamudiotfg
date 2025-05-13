<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $coupon = session()->get('applied_coupon');

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $discount = 0;
        if ($coupon) {
            if ($coupon['type'] === 'percentage') {
                $discount = $subtotal * ($coupon['discount'] / 100);
            } elseif ($coupon['type'] === 'fixed') {
                $discount = $coupon['discount'];
            }
        }

        $total = max($subtotal - $discount, 0);

        return view('cart.index', compact('cart', 'subtotal', 'discount', 'total', 'coupon'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        $image = $product->images()->first();
        $imageUrl = $image ? asset('storage/' . $image->image_path) : 'https://via.placeholder.com/150';

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + 1 : 1,
            'image' => $imageUrl,
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
        $coupon = session()->get('applied_coupon');
        return view('cart.checkout', compact('cart', 'coupon'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return back()->with('error', 'Cupón no válido o expirado.');
        }

        session()->put('applied_coupon', $coupon);

        return back()->with('success', 'Cupón aplicado correctamente.');
    }


    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $discount = 0;
        $coupon = session('applied_coupon');

        if ($coupon) {
            if ($coupon['type'] === 'percentage') {
                $discount = $total * ($coupon['discount'] / 100);
            } elseif ($coupon['type'] === 'fixed') {
                $discount = $coupon['discount'];
            }
        }

        $totalAfterDiscount = max($total - $discount, 0);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->wallet_balance < $totalAfterDiscount) {
            return redirect()->back()->with('error', 'Saldo insuficiente en tu cartera virtual.');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'total' => $totalAfterDiscount,
                'shipping_address' => $request->input('shipping_address'),
            ]);

            foreach ($cart as $productId => $item) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $user->wallet_balance -= $totalAfterDiscount;
            $user->save();

            session()->forget('cart');
            session()->forget('applied_coupon');

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pago realizado con éxito. ¡Gracias por tu compra!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
}
