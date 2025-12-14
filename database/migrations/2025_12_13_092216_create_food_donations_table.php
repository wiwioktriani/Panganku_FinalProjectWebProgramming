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
        Schema::create('food_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            $table->foreignId('food_category_id')->constrained('food_categories')->cascadeOnDelete();

            //data makanan
            $table->string('food_name');
            $table->integer('quantity');
            $table->date('expired_at');

            //status donasi
            $table->enum('status', [
                'available', 
                'taken', 
                'expired'
            ])->default('available');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_donations');
    }
};
