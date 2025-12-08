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
        Schema::create('hasil_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_guru_id')->constrained('user_guru')->cascadeOnDelete();
            $table->string('instansi');
            $table->string('posisi_dilamar');
            $table->decimal('nilai_profile_dan_kepribadian', 8, 2);
            $table->decimal('nilai_pedagogy', 8, 2);
            $table->decimal('nilai_teknologi_dan_desain', 8, 2);
            $table->decimal('nilai_asesmen_dan_sosial', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('namapenilai1');
            $table->string('namapenilai2')->nullable();
            $table->string('namapenilai3')->nullable();
            $table->string('namapenilai4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian');
    }
};
