<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            🛒 Bienvenido a nuestra tienda online
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">

            {{-- Sección: Productos Destacados --}}
            <section>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">🌟 Productos Destacados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-2xl overflow-hidden transition">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->url) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-blue-600">${{ $product->price }}</span>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">Añadir al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Sección: Nuevos Productos --}}
            <section>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">🆕 Nuevos Productos</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($newProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-2xl overflow-hidden transition">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->url) }}" class="w-full h-48 object-cover" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-48 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold truncate">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-green-600">${{ $product->price }}</span>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Sección: Últimas Valoraciones --}}
            <section>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">🗣️ Últimas Valoraciones</h2>
                <div class="space-y-6">
                    @foreach($latestReviews as $review)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-800 dark:text-white">{{ $review->user->name }}</p>
                                <div class="text-yellow-400 text-lg">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        ★
                                    @endfor
                                    @for ($i = $review->rating; $i < 5; $i++)
                                        ☆
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
