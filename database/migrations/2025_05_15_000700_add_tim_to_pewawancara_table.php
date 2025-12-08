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
        Schema::table('pewawancara', function (Blueprint $table) {
            $table->enum('tim', ['Tim A', 'Tim B', 'Tim C', 'Tim D'])->default('Tim A')->after('instansi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pewawancara', function (Blueprint $table) {
            $table->dropColumn('tim');
        });
    }
};
