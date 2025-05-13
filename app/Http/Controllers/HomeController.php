<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::inRandomOrder()->take(5)->get();

        $newProducts = Product::latest()->take(5)->get();

        $latestReviews = Review::latest()->take(5)->with('user')->get();

        $allProducts = Product::with('images')->get();

        return view('dashboard', compact('featuredProducts', 'newProducts', 'latestReviews', 'allProducts'));
    }
}
