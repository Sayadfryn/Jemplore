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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->foreignId('tourism_object_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('submission_type');
            
            $table->json('payload');
            
            $table->string('proof_document')->nullable();
            
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->text('admin_feedback')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
