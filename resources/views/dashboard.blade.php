<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Productos Destacados</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($featuredProducts as $product)
                            <div class="border rounded p-4">
                                <h3 class="font-semibold text-xl">{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <span class="text-lg font-bold">${{ $product->price }}</span>
                            </div>
                        @endforeach
                    </div>

                    <h2 class="text-2xl font-bold mb-6 mt-12">Nuevos Productos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($newProducts as $product)
                            <div class="border rounded p-4">
                                <h3 class="font-semibold text-xl">{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <span class="text-lg font-bold">${{ $product->price }}</span>
                            </div>
                        @endforeach
                    </div>

                    <h2 class="text-2xl font-bold mb-6 mt-12">Últimas Valoraciones</h2>
                    <div>
                        @foreach($latestReviews as $review)
                            <div class="mb-4">
                                <p><strong>{{ $review->user->name }}:</strong> {{ $review->comment }}</p>
                                <p>Rating: {{ $review->rating }} stars</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
