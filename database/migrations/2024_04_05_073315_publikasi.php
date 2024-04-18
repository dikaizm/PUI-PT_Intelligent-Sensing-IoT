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
        Schema::create('publikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_article_id');
            $table->foreignId('publisher_id');
            $table->tinyInteger('status_jurnal_id');
            $table->integer('indexing')->nullable();
            $table->string('link_jurnal')->nullable();
            $table->timestamps();
        });
        Schema::create('publisher', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('status_jurnal', function (Blueprint $table) {
            $table->tinyInteger('id')->autoIncrement()->primary();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publikasi');
        Schema::dropIfExists('publisher');
        Schema::dropIfExists('status_jurnal');
    }
};
