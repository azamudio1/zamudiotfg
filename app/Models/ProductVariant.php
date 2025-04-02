<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'color', 'price'];

    // Relación con el producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con los detalles de pedidos
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relación con los carritos
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

