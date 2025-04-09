<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener productos destacados, nuevos productos y últimas valoraciones
        $featuredProducts = Product::inRandomOrder()->take(5)->get();  // Puedes cambiar la lógica para productos destacados
        $newProducts = Product::latest()->take(5)->get();
        $latestReviews = Review::latest()->take(5)->get();

        // Pasar las variables a la vista 'dashboard'
        return view('dashboard', compact('featuredProducts', 'newProducts', 'latestReviews'));
    }
}
