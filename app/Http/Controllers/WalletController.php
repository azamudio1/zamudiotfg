<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('wallet', compact('user'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        $user->wallet_balance += $request->amount;
        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('wallet.show')->with('success', 'Saldo añadido correctamente.');
    }
}

