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
        Schema::create('culinaries', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tourism_object_id')->constrained()->onDelete('cascade');
            
            $table->string('name');
            $table->string('image')->nullable();
            
            $table->text('description')->nullable(); 
            $table->string('primary_tag'); 
            $table->json('secondary_tags')->nullable(); 
            
            $table->enum('price_type', ['single', 'range'])->default('single');
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('min_price', 12, 2)->nullable();
            $table->decimal('max_price', 12, 2)->nullable();
            
            $table->string('best_at')->nullable(); 
            
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culinaries');
    }
};
