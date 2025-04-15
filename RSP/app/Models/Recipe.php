<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Recipe extends Model
// {
//     //
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'title',
        'description',
        'instruction',
        'user_id',
        'category_id',
        'image',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }
    public function getRatingsAvgRatingAttribute()
    {
        return $this->ratings()->avg('rating');  // Average the rating values
    }

   
}

