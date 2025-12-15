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
        Schema::table('packages', function (Blueprint $table) {
        $table->foreignId('tourism_object_id')
              ->after('id')
              ->nullable()
              ->constrained('tourism_objects')
              ->cascadeOnDelete();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropForeign(['tourism_object_id']);
                $table->dropColumn('tourism_object_id');
            });
        });
    }
};
