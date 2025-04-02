<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create($request->all());

        return response()->json($review, 201);
    }

    public function show($id)
    {
        return response()->json(Review::find($id));
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Valoración no encontrada'], 404);
        }

        $review->update($request->all());

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json(['message' => 'Valoración no encontrada'], 404);
        }

        $review->delete();

        return response()->json(['message' => 'Valoración eliminada'], 200);
    }
}
