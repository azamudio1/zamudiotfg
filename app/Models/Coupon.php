<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'type', 'expires_at'];

    // Relación con los pedidos (si es necesario aplicar el cupón)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
