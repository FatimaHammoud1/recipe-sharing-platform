<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Build the query
        $query = Recipe::query();
    
        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
    
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
    
        // Get the filtered recipes
        $recipes = $query->get();
    
        // Return the view with the recipes and categories
        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        // Retrieve all categories from the database
        $categories = Category::all();  // Or use Category::pluck('id', 'name') if you need a custom list

        // Return the create view with categories
        return view('recipes.create', compact('categories'));  // Pass $categories to the view
    }




public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|unique:recipes,title|max:255',
        'description' => 'required|string',
        'instruction' => 'required|string',
        'ingredient' => 'string|required',
        'category_id' => 'required|exists:categories,id',
        // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image' => 'nullable|string',

        // 'ingredients' => 'required|array|min:1',
        
    ]);

    // Create a new recipe
    $recipe = new Recipe();
    $recipe->title = $request->title;
    $recipe->description = $request->description;
    $recipe->instruction = $request->instruction;
    $recipe->ingredient = $request->ingredient;
    $recipe->image = $request->image;

    $recipe->category_id = $request->category_id;
    $recipe->user_id = auth()->id();
    
  
    $recipe->save();

    return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
}


    public function show($id)
    {
        // Eager load the recipe with comments and their associated user data
        $recipe = Recipe::with('comments.user', 'ratings')->find($id);

        // Calculate the average rating
        $averageRating = $recipe->ratings->avg('rating');

        // Fetch the current user's rating (if any)
        $userRating = $recipe->ratings()->where('user_id', auth()->id())->first();

        return view('recipes.show', compact('recipe', 'averageRating', 'userRating'));
    }



    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Ensure only the owner or an admin can edit
        if (Auth::id() !== $recipe->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('recipes.index')->with('error', 'You do not have permission to edit this recipe.');
        }

        $categories = Category::all(); // Fetch all categories for selection
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        // Ensure only the owner or an admin can update
        if (Auth::id() !== $recipe->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('recipes.index')->with('error', 'You do not have permission to update this recipe.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:recipes,title,' . $id,
            'description' => 'required|string',
            'instruction' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string',
        ]);

        $recipe->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'instruction' => $validated['instruction'],
            'image' => $validated['image'],
            'category_id' => $validated['category_id'],
        ]);

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }
  
    public function destroy($id)
{
    $recipe = Recipe::findOrFail($id);

    // Check if the user is the owner or an admin
    if (auth()->user()->id == $recipe->user_id || auth()->user()->role == 'admin') {
        // Delete the recipe
        $recipe->delete();
        
        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.recipes.index')->with('success', 'Recipe deleted successfully.');
        }
        else{
            return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
        }
        
    }

    // If the user is not the owner or an admin, return a forbidden response
    return redirect()->route('recipes.index')->with('error', 'You are not authorized to delete this recipe.');
}
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}

