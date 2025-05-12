@extends('layouts.app')

@section('content')
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-24">

            {{-- Hero o cabecera visual --}}
            <section class="relative bg-blue-600/90 dark:bg-blue-800/90 text-white rounded-3xl p-10 shadow-xl overflow-hidden">
                <div class="max-w-4xl z-10 relative">
                    <h1 class="text-5xl font-extrabold mb-4">Bienvenido a la tienda</h1>
                    <p class="text-xl font-light">Descubre nuestros productos más destacados y todas las novedades.</p>
                </div>
                <div class="absolute right-0 bottom-0 opacity-30 w-1/2 hidden md:block">
                    <img src="https://cdn-icons-png.flaticon.com/512/3534/3534108.png" alt="Store Icon" class="w-full h-auto">
                </div>
            </section>

            {{-- Productos Destacados --}}
            @if ($featuredProducts->count())
                <section>
                    <h2 class="text-4xl font-bold text-white mb-10">Productos Destacados</h2>
                    <div class="grid gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                        @foreach($featuredProducts as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-2xl transition transform hover:scale-[1.02]">
                                <a href="{{ route('products.show', $product->id) }}">
                                    @if ($product->images->first())
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                             class="w-full h-56 object-cover rounded-t-2xl" loading="lazy" alt="{{ $product->name }}">
                                    @endif
                                </a>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $product->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 60) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xl font-bold text-blue-600 dark:text-blue-400">${{ $product->price }}</span>
                                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                            @csrf
                                            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-xl shadow">Añadir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Todos los Productos --}}
            <section>
                <h2 class="text-4xl font-bold text-white mb-10">Todos los Productos</h2>
                <div class="grid gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @foreach($allProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow hover:shadow-2xl transition transform hover:scale-[1.02]">
                            <a href="{{ route('products.show', $product->id) }}">
                                @if ($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                         class="w-full h-56 object-cover rounded-t-2xl" loading="lazy" alt="{{ $product->name }}">
                                @endif
                            </a>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $product->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ Str::limit($product->description, 60) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-green-600 dark:text-green-400">${{ $product->price }}</span>
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                        @csrf
                                        <button class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-xl shadow">Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Últimas Valoraciones --}}
            @if ($latestReviews->count())
                <section>
                    <h2 class="text-4xl font-bold text-white mb-10">Últimas Valoraciones</h2>
                    <div class="space-y-6">
                        @foreach($latestReviews as $review)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                                <div class="flex items-center justify-between">
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $review->user->name }}</p>
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
            @endif

        </div>
    </div>
@endsection
