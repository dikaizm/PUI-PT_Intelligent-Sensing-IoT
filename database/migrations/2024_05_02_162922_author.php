<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penelitian_id');
            $table
                ->foreign('penelitian_id')
                ->references('id')
                ->on('penelitian')
                ->onDelete('restrict');
            $table->foreignId('user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
            $table->boolean('is_corresponding')->default(false);
            $table->boolean('is_ketua')->default(false);
        });

        Schema::create('author_output', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table
                ->foreign('author_id')
                ->references('id')
                ->on('author')
                ->onDelete('restrict');
            $table->foreignId('output_id');
            $table
                ->foreign('output_id')
                ->references('id')
                ->on('output')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author');
        Schema::dropIfExists('author_output');
    }
};
