<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        // DB::table('users')->truncate();
        // DB::table('categories')->truncate();
        // DB::table('recipes')->truncate();

        // Seed Users
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@sharedspoon.com',
                'password' => bcrypt('admin123'),
                
                'is_admin' => true, // Admin user
                'role' =>'admin',
                'created_at' => now(),
                
                'updated_at' => now()
            ],
            [
                'name' => 'Chef Gordon',
                'email' => 'gordon@sharedspoon.com',
                'password' => bcrypt('password123'),
                'is_admin' => false, // Regular user
                'role' =>'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Home Cook Sarah',
                'email' => 'sarah@sharedspoon.com',
                'password' => bcrypt('password123'),
                'is_admin' => false, // Regular user
                'role' =>'user',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Seed Categories
        DB::table('categories')->insert([
            [
                'name' => 'Breakfast',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lunch',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dinner',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dessert',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vegan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Seed Recipes
        DB::table('recipes')->insert([
            [
                'title' => 'Classic Beef Burger',
                'description' => 'A juicy beef burger with fresh toppings and a soft bun.',
                'instruction' => '1. Form beef patties. 2. Grill patties for 5 minutes on each side. 3. Toast buns. 4. Assemble with lettuce, tomato, and cheese.',
                'ingredient' => json_encode([
                    '500g ground beef',
                    '1 onion',
                    '4 burger buns',
                    'Lettuce',
                    'Tomato',
                    'Cheese slices'
                ]),
                'user_id' => 2, // Chef Gordon
                'category_id' => 2, // Lunch
                'image' => 'https://www.allrecipes.com/thmb/cJokITJ9_AEjIDpK2YGMM18Ai7E=/160x90/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/25473-the-perfect-basic-burger-DDMFS-4x3-56eaba3833fd4a26a82755bcd0be0c54.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Chocolate Lava Cake',
                'description' => 'A decadent chocolate cake with a gooey molten center.',
                'instruction' => '1. Melt chocolate and butter. 2. Mix sugar, eggs, and flour. 3. Bake at 180°C for 12 minutes.',
                'ingredient' => json_encode([
                    '200g dark chocolate',
                    '100g butter',
                    '150g sugar',
                    '4 eggs',
                    '60g flour'
                ]),
                'user_id' => 3, // Home Cook Sarah
                'category_id' => 4, // Dessert
                'image' => 'https://sallysbakingaddiction.com/wp-content/uploads/2017/02/lava-cake.jpg',
            
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Vegan Buddha Bowl',
                'description' => 'A healthy and colorful vegan bowl packed with nutrients.',
                'instruction' => '1. Cook quinoa. 2. Roast vegetables. 3. Assemble with greens and dressing.',
                'ingredient' => json_encode([
                    '1 cup quinoa',
                    '1 sweet potato',
                    '1 avocado',
                    'Handful of kale',
                    'Tahini dressing'
                ]),
                'user_id' => 3, // Home Cook Sarah
                'category_id' => 5, // Vegan
                'image' => 'https://vikalinka.com/wp-content/uploads/2024/03/Buddha-Bowl-5-Edit.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}