<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecipeService;

class SpoonacularController extends Controller
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $recipes = $this->recipeService->searchRecipes($query);

        return view('spoon.search', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = $this->recipeService->getRecipeDetails($id);

        return view('spoon.show', compact('recipe'));
    }
}
