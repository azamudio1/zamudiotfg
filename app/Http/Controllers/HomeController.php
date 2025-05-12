<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // Productos destacados (puedes cambiar la lógica según algún flag o categoría en tu modelo)
        $featuredProducts = Product::inRandomOrder()->take(5)->get();

        // Nuevos productos (opcional si decides mantener esta sección)
        $newProducts = Product::latest()->take(5)->get();

        // Últimas valoraciones
        $latestReviews = Review::latest()->take(5)->with('user')->get();

        // Todos los productos para el catálogo completo
        $allProducts = Product::with('images')->get();

        return view('dashboard', compact('featuredProducts', 'newProducts', 'latestReviews', 'allProducts'));
    }
}
