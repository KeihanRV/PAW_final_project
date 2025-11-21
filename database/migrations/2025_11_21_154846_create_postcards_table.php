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
        Schema::create('postcards', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            
            // 1. CONTINENT (Dropdown)
            $table->enum('continent', [
                'Classic of Europe', 
                'Classic of Asia', 
                'Classic of Africa', 
                'Classic of America'
            ]);

            // 2. INPUTS
            $table->string('city');
            $table->string('country');
            $table->text('description');
            
            // 3. GAMBAR
            $table->string('image'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postcards');
    }
};
