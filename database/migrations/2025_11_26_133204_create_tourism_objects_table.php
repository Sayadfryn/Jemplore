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
        Schema::create('tourism_objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('thumbnail')->nullable(); 
            
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
            $table->string('ticket_price')->nullable(); 

            $table->string('contact_number')->nullable();
            
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourism_objects');
    }
};
