<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'has_variants'];

    // Relación con variantes
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Relación con imágenes
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relación con valoraciones
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relación con detalles de pedidos
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}


