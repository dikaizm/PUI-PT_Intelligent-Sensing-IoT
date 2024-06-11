<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('target_penelitian', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->integer('target')->default(10); // Default target 10
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('target_penelitian');
    }
};
