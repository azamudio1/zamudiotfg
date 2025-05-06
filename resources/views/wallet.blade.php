<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Cartera') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="mb-4 text-green-600 font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                    Saldo actual: <span class="text-blue-600 dark:text-blue-400">€{{ number_format($user->wallet_balance, 2) }}</span>
                </h3>

                <form action="{{ route('wallet.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad a añadir (€):</label>
                        <input type="number" name="amount" min="1" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                        @error('amount')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Añadir saldo
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
