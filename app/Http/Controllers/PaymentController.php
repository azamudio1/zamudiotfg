<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;

class PaymentController extends Controller
{
    public function createPayment(Order $order)
    {
        $paypal = new PayPalClient;

        $payment = $paypal->setExpressCheckout([
            'items' => [
                [
                    'name' => 'Producto 1',
                    'price' => $order->total,
                    'qty' => 1,
                ],
            ],
            'invoice_id' => uniqid(),
            'return_url' => route('paypal.success'),
            'cancel_url' => route('paypal.cancel'),
        ]);

        if ($payment) {
            return redirect()->away($payment->paypal_link);
        }

        return redirect()->back()->withErrors('Error al crear el pago.');
    }

    public function handlePaymentSuccess(Request $request)
    {
        $paypal = new PayPalClient;

        $payment = $paypal->getExpressCheckoutDetails($request->token);

        if ($payment['ACK'] == 'Success') {
            // Marcar el pedido como pagado
            $order = Order::find($request->order_id);
            $order->status = 'paid';
            $order->save();

            return redirect()->route('orders.show', $order);
        }

        return redirect()->route('orders.index')->withErrors('Error al procesar el pago.');
    }

    public function handlePaymentCancel()
    {
        return redirect()->route('orders.index')->with('message', 'Pago cancelado');
    }
}

