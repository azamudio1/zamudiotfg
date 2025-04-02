<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'variant_id', 'quantity'];

    // Relación con el carrito
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con la variante
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}

