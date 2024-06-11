<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnOutputDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('output_detail', function (Blueprint $table) {
            // Hapus constraint kunci asing yang ada
            $table->dropForeign(['output_id']);

            // Tambahkan constraint kunci asing baru dengan ON DELETE CASCADE
            $table->foreign('output_id')
                ->references('id')
                ->on('output')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('output_detail', function (Blueprint $table) {
            // Hapus constraint kunci asing yang baru
            $table->dropForeign(['output_id']);

            // Kembalikan constraint kunci asing yang lama tanpa ON DELETE CASCADE
            $table->foreign('output_id')
                ->references('id')
                ->on('output');
        });
    }
}

