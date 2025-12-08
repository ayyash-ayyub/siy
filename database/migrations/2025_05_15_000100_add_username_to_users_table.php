<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('id');
        });

        $users = DB::table('users')->select('id', 'email', 'name')->get();

        foreach ($users as $user) {
            $base = $user->email ?: ($user->name ? Str::slug($user->name, '.') : 'user'.$user->id);
            $candidate = $base ?: 'user'.$user->id;
            $suffix = 1;

            while (
                DB::table('users')
                    ->where('username', $candidate)
                    ->where('id', '!=', $user->id)
                    ->exists()
            ) {
                $candidate = $base.'_'.$suffix;
                $suffix++;
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['username' => $candidate]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_username_unique');
            $table->dropColumn('username');
        });
    }
};
