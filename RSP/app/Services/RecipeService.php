<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecipeService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('SPOONACULAR_API_KEY');
    }

    public function searchRecipes($query)
    {
        $url = "https://api.spoonacular.com/recipes/complexSearch";
        $response = Http::get($url, [
            'apiKey' => $this->apiKey,
            'query' => $query,
            'number' => 10, // Limit to 10 recipes
        ]);

        if ($response->failed()) {
            // Handle failure, maybe log or return a default response
            return ['error' => 'Unable to fetch data from Spoonacular'];
        }

        return $response->json();
    }

    public function getRecipeDetails($recipeId)
    {
        $url = "https://api.spoonacular.com/recipes/{$recipeId}/information";
        $response = Http::get($url, [
            'apiKey' => $this->apiKey,
        ]);

        return $response->json();
    }

  
   
    
}
