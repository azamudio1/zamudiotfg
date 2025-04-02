<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        return response()->json(Coupon::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons',
            'discount' => 'required|numeric',
            'type' => 'required|string',
        ]);

        $coupon = Coupon::create($request->all());

        return response()->json($coupon, 201);
    }

    public function show($id)
    {
        return response()->json(Coupon::find($id));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Cupón no encontrado'], 404);
        }

        $coupon->update($request->all());

        return response()->json($coupon);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json(['message' => 'Cupón no encontrado'], 404);
        }

        $coupon->delete();

        return response()->json(['message' => 'Cupón eliminado'], 200);
    }
}

