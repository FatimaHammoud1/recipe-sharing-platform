<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Recipe; // Changed from Post to Recipe
use App\Models\User;

class AdminController extends Controller
{
// Debugging: Check if the class exists

    
    // Dashboard view
    public function index()
    {
        
        $totalRecipes = Recipe::count(); // Changed from totalPosts to totalRecipes
        $totalUsers = User::count();
        return view('admin.dashboard', compact('totalRecipes', 'totalUsers')); // Updated variable name
    }

    // Manage recipes
    public function manageRecipes() // Changed from managePosts to manageRecipes
    {
        $recipes = Recipe::all(); // Changed from $posts to $recipes
        $totalRecipes = Recipe::count(); // Changed from Post to Recipe
        return view('admin.recipes.index', compact('totalRecipes','recipes')); // Changed from posts to recipes
    }

   
  

   
    
    // Manage users
    public function manageUsers()
    {
        $users = User::all();
        $totalUsers = User::count();
        return view('admin.users.index', compact('totalUsers','users'));
    }


    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

   
    public function updateUser(Request $request, User $user)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);
    
        // Determine if the user is an admin based on the role selected
        $isAdmin = $request->role === 'admin' ? true : false;
    
        // Update user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_admin' => $isAdmin, // Set is_admin based on the selected role
        ]);
    
        // Redirect back with a success message
        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User updated successfully!');
    }
    



    // Middleware to ensure only admin can access
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Assuming you have an 'admin' middleware to restrict access
    }


    // Category management - show all categories
    public function categoryManagement()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Create a new category
    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Delete category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
 
}