<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

// Schema::create('recipes', function (Blueprint $table) {
            
//     $table->id();
//     $table->string('title', 255)->unique();
//     $table->text('description');
//     $table->text('instruction');
//     $table->foreignId('user_id')->constrained()->onDelete('cascade');
//     $table->foreignId('category_id')->constrained()->onDelete('cascade');
//     $table->string('image')->nullable();

//     $table->timestamps();
// });