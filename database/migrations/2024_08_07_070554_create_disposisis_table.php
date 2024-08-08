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
            $table->text('perihal');
            $table->text('ditujukan')->nullable();
            $table->text('instruksi')->nullable();
            $table->text('catatan')->nullable();
            $table->text('keterangan')->nullable();
            $table->dateTime('tgl_input')->nullable();
            $table->string('jabatan');
            $table->string('pic');
            $table->string('user');
            $table->dateTime('tgl_verify')->nullable();
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
