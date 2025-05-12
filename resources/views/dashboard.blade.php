@extends('layouts.app')

@section('content')
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-24">

            {{-- Sección: Productos Destacados --}}
            <section>
                <h2 class="text-5xl font-extrabold text-white mb-10">🌟 Productos Destacados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl overflow-hidden transform transition duration-300 hover:scale-[1.03]">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                         class="w-full h-56 object-cover" loading="lazy" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-56 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-semibold truncate text-gray-800 dark:text-white">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">${{ $product->price }}</span>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-5 py-2 rounded-2xl shadow">Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Sección: Nuevos Productos --}}
            <section>
                <h2 class="text-5xl font-extrabold text-white mb-10">🆕 Nuevos Productos</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                    @foreach($newProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl overflow-hidden transform transition duration-300 hover:scale-[1.03]">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                         class="w-full h-56 object-cover" loading="lazy" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-56 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-semibold truncate text-gray-800 dark:text-white">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">${{ $product->price }}</span>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button class="bg-green-600 hover:bg-green-700 text-white text-sm px-5 py-2 rounded-2xl shadow">Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Sección: Últimas Valoraciones --}}
            <section>
                <h2 class="text-5xl font-extrabold text-white mb-10">🗣️ Últimas Valoraciones</h2>
                <div class="space-y-6">
                    @foreach($latestReviews as $review)
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-xl">
                            <div class="flex items-center justify-between">
                                <p class="font-bold text-gray-900 dark:text-white">{{ $review->user->name }}</p>
                                <div class="text-yellow-400 text-xl">
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
@endsection
