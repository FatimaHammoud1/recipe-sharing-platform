<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id', // Make sure recipe exists
            'comment' => 'required|string|max:500', // Comment text must be valid
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->recipe_id = $request->recipe_id;
        $comment->user_id = Auth::id(); // Store the current authenticated user's ID
        $comment->comment = $request->comment;

        // Save the comment in the database
        $comment->save();

        // Redirect back to the recipe page with a success message
        return redirect()->route('recipes.show', $request->recipe_id)
                         ->with('success', 'Your comment has been posted!');
    }
    
        public function index()
        {
            // Fetch comments with related recipe and user (owner)
            $comments = Comment::with(['user', 'recipe'])->get();
    
            return view('admin.comments.index', compact('comments'));
        }
    
        public function destroy($id)
        {
            $comment = Comment::find($id);
            if ($comment) {
                $comment->delete();
                return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
            }
            return redirect()->route('admin.comments.index')->with('error', 'Comment not found.');
        }
    }


