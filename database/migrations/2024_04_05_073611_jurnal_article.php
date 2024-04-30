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
        Schema::create('jurnal_article', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('judul');
            $table->tinyInteger('tingkatan_tkt');
            $table->bigInteger('pendanaan')->nullable();
            $table->string('jangka_waktu', 32)->nullable();
            $table->string('poster')->nullable();
            $table->string('prototype')->nullable();
            $table->string('link_video')->nullable();
            $table->string('file_proposal')->nullable();
            $table->text('feedback')->nullable();
            $table->tinyInteger('status_laporan_id');
            $table->tinyInteger('jenis_penelitian_id');
            $table->tinyInteger('mitra_id');
            $table->tinyInteger('jenis_output_id');
            $table->boolean('arsip');
            $table->timestamps();
        });
        Schema::create('status_laporan_key', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 32);
            $table->timestamps();
        });
        Schema::create('status_laporan', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->autoIncrement();
            $table->tinyInteger('status_laporan_key_id')->unsigned();
            $table->string('name', 32);
            $table->timestamps();
            $table
                ->foreign('status_laporan_key_id')
                ->references('id')
                ->on('status_laporan_key')
                ->onDelete('restrict');
        });
        Schema::create('jenis_penelitian', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 32);
            $table->timestamps();
        });
        Schema::create('mitra', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 64);
            $table->timestamps();
        });
        Schema::create('jenis_output', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_article');
        Schema::dropIfExists('status_laporan');
        Schema::dropIfExists('status_laporan_key');
        Schema::dropIfExists('jenis_penelitian');
        Schema::dropIfExists('mitra');
        Schema::dropIfExists('jenis_output');
    }
};
