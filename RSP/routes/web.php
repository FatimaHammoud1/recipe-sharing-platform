<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;



use App\Http\Controllers\SpoonacularController;


Route::get('/spoon/search', [SpoonacularController::class, 'search'])->name('spoon.search');
Route::get('/spoon/{id}', [SpoonacularController::class, 'show'])->name('spoon.show');



Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/recipe/{recipe}/rate', [RatingController::class, 'store'])->name('recipes.rate');

Route::get('/recipes/index', [RecipeController::class, 'index'])->name('recipes.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});



Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
// Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout')->middleware('auth');
Auth::routes();
// Login
// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');





Route::middleware(['auth' , 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Route::get('/recipes', [RecipeController::class, 'index'])->name('admin.recipes'); // GET request (for managing recipes)
    Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('admin.recipes.delete');
   
    Route::get('/admin/recipes', [AdminController::class, 'manageRecipes'])->name('admin.recipes.index');

   

    // Routes for managing users
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
 
     // Show the user edit form
     Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');

     // Handle the update user request
     Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');




     Route::delete('admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
     


    

    
        Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('admin.comments.delete');
    
    


    // Category Management
    Route::get('categories', [AdminController::class, 'categoryManagement'])->name('admin.categories.index');
    Route::post('categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
});