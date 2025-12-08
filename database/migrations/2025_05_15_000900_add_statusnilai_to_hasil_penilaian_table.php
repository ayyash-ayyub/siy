<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hasil_penilaian', function (Blueprint $table) {
            $table->boolean('statusnilai')->default(0)->after('total');
        });

        DB::table('hasil_penilaian')->update(['statusnilai' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_penilaian', function (Blueprint $table) {
            $table->dropColumn('statusnilai');
        });
    }
};
