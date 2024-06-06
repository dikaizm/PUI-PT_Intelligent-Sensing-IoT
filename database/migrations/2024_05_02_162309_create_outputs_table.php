<?php

use App\Enums\OutputType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_output_key', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name', 64);
            $table->timestamps();
        });
        Schema::create('jenis_output', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('jenis_output_key_id')->unsigned();
            $table
                ->foreign('jenis_output_key_id')
                ->references('id')
                ->on('jenis_output_key')
                ->onDelete('restrict');
            $table->string('name', 32);
            $table->timestamps();
        });
        Schema::create('status_output', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned()->autoIncrement()->primary();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('output', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penelitian_id');
            $table
                ->foreign('penelitian_id')
                ->references('id')
                ->on('penelitian')
                ->onDelete('restrict');
            $table->timestamps();
        });

        Schema::create('output_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('output_id');
            $table
                ->foreign('output_id')
                ->references('id')
                ->on('output')
                ->onDelete('restrict');
            $table->foreignId('jenis_output_id');
            $table
                ->foreign('jenis_output_id')
                ->references('id')
                ->on('jenis_output')
                ->onDelete('restrict');
            $table->smallInteger('status_output_id')->unsigned();
            $table
                ->foreign('status_output_id')
                ->references('id')
                ->on('status_output')
                ->onDelete('restrict');
            $table
                ->enum('tipe', OutputType::getValues())
                ->default(OutputType::NULL());
            $table->string('judul');
            $table->string('tautan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_output_key');
        Schema::dropIfExists('jenis_output');
        Schema::dropIfExists('status_output');
        Schema::dropIfExists('output');
        Schema::dropIfExists('output_detail');
    }
};
