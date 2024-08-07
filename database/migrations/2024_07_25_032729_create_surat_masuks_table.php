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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->nullable();
            $table->string('kode_surat')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->string('asal_surat');
            $table->text('perihal');
            $table->text('keterangan')->nullable();
            $table->string('filename')->nullable();
            $table->string('fileurl')->nullable();
            $table->string('sifat')->nullable();
            $table->string('jenis')->nullable();
            $table->string('pic_input');
            $table->string('user_input');
            $table->dateTime('tgl_input');
            $table->text('user_disposisi');
            $table->string('pic_selesai')->nullable();
            $table->string('user_selesai')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
