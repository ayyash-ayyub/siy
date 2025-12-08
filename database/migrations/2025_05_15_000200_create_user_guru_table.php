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
        Schema::create('user_guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik')->unique();
            $table->string('nama');
            $table->string('mapel');
            $table->unsignedBigInteger('nip')->unique();
            $table->string('pangkat');
            $table->string('instansi');
            $table->string('jenjang');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_guru');
    }
};
