<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Comment extends Model
// {
//     //
// }
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'comment',
        'recipe_id',
        'user_id',
    ];

    // Relationships
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
