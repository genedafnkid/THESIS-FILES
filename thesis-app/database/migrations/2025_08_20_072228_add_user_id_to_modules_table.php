<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('modules')) return;

        Schema::table('modules', function (Blueprint $table) {
            if (!Schema::hasColumn('modules', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('modules')) return;

        Schema::table('modules', function (Blueprint $table) {
            if (Schema::hasColumn('modules', 'user_id')) {
                try { $table->dropForeign('modules_user_id_foreign'); }
                catch (\Throwable $e) { try { $table->dropForeign(['user_id']); } catch (\Throwable $e2) {} }

                $table->dropColumn('user_id');
            }
        });
    }
};
