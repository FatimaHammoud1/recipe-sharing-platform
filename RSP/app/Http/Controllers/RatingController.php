<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $rating = new Rating();
        $rating->user_id = auth()->id();
        $rating->rating = $request->input('rating');
        $rating->rateable_type = Recipe::class;
        $rating->rateable_id = $recipe->id;
        $rating->save();

        return back()->with('success', 'Thank you for your rating!');
    }
}
