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
        Schema::create('output', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('jenis_dokumen_id')->unsigned();
            $table
                ->foreign('jenis_dokumen_id')
                ->references('id')
                ->on('jenis_dokumen')
                ->onDelete('restrict');
            $table->foreignId('penelitian_id');
            $table
                ->foreign('penelitian_id')
                ->references('id')
                ->on('penelitian')
                ->onDelete('restrict');
            $table->foreignId('publisher_id');
            $table
                ->foreign('publisher_id')
                ->references('id')
                ->on('publisher')
                ->onDelete('restrict');
            $table->smallInteger('status_jurnal_id')->unsigned();
            $table
                ->foreign('status_jurnal_id')
                ->references('id')
                ->on('status_jurnal')
                ->onDelete('restrict');
            $table->text('keterangan');
            $table->string('tautan');
            $table->timestamps();
        });
        Schema::create('publisher_key', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 64);
            $table->timestamp();
        });
        Schema::create('publisher', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('publisher_key_id')->unsigned();
            $table
                ->foreign('publisher_key_id')
                ->references('id')
                ->on('publisher_key')
                ->onDelete('restrict');
            $table->string('tingkat_index', 32);
            $table->timestamp();
        });
        Schema::create('status_jurnal', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output');
        Schema::dropIfExists('publisher_key');
        Schema::dropIfExists('publisher');
        Schema::dropIfExists('status_jurnal');
    }
};
