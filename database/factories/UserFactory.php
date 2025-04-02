<?php

// Estructura de base de datos para la tienda online en Laravel

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Tabla de usuarios
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('role', ['admin', 'customer'])->default('customer');
    $table->timestamps();
});

// Tabla de productos
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2);
    $table->boolean('has_variants')->default(false);
    $table->timestamps();
});

// Tabla de variantes de productos
Schema::create('product_variants', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->string('size')->nullable();
    $table->string('color')->nullable();
    $table->decimal('price', 10, 2)->nullable();
    $table->timestamps();
});

// Tabla de imágenes de productos
Schema::create('product_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->string('image_path');
    $table->timestamps();
});

// Tabla de pedidos
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('status', ['pending', 'paid', 'shipped', 'cancelled'])->default('pending');
    $table->decimal('total', 10, 2);
    $table->timestamps();
});

// Tabla de detalles de pedidos
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('set null');
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->timestamps();
});

// Tabla de carritos abandonados
Schema::create('carts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

Schema::create('cart_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cart_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('set null');
    $table->integer('quantity');
    $table->timestamps();
});

// Tabla de cupones y descuentos
Schema::create('coupons', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique();
    $table->decimal('discount', 10, 2);
    $table->enum('type', ['percentage', 'fixed']);
    $table->date('expires_at')->nullable();
    $table->timestamps();
});

// Tabla de valoraciones de productos
Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->integer('rating');
    $table->text('comment')->nullable();
    $table->timestamps();
});

?>
