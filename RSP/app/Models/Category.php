<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Category extends Model
// {
//     //
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'name',
    ];

    // Relationships
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}

