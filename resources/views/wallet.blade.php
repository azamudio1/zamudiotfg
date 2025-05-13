@extends('layouts.app')

@section('content')
    <div class="relative py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Encabezado visual --}}
            <section class="bg-gradient-to-r from-green-600 via-emerald-500 to-teal-400 text-white rounded-3xl p-10 shadow-xl">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-2">Tu Cartera</h1>
                <p class="text-lg font-light">Gestiona tu saldo y realiza compras sin complicaciones.</p>
            </section>

            {{-- Contenido --}}
            <section class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8">
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 font-semibold rounded-lg border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Saldo actual:
                        <span class="text-green-600 dark:text-green-400">€{{ number_format($user->wallet_balance, 2) }}</span>
                    </h2>
                </div>

                <form action="{{ route('wallet.add') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cantidad a añadir (€)</label>
                        <input type="number" name="amount" min="1" step="0.01"
                            class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white shadow focus:ring-2 focus:ring-green-500"
                            required>
                        @error('amount')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-all shadow-lg">
                            Añadir saldo
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
