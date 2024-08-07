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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->string('id_surat');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->string('disposisi');
            $table->string('instruksi');
            $table->string('catatan')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('pic_disposisi')->nullable();
            $table->string('user_disposisi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
