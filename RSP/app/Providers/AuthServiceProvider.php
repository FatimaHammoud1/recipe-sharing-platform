<?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AuthServiceProvider extends ServiceProvider
// {
//     /**
//      * Register services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap services.
//      */
//     public function boot(): void
//     {
//         //
//     }
// }
namespace App\Providers;

use App\Models\Recipe;
use App\Policies\RecipePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Recipe::class => RecipePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
