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
            $table->bigInteger('jurnal_article_id');
            $table->bigInteger('user_id');
            $table->boolean('is_corresponding')->default(false);
            $table->boolean('is_ketua')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author');
    }
};
