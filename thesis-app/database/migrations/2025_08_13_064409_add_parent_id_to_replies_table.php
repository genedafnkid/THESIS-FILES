<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('replies')) return;

        Schema::table('replies', function (Blueprint $table) {
            // id() uses BIGINT UNSIGNED, so match that with foreignId()
            $table->foreignId('parent_id')
                  ->nullable()
                  ->after('post_id')
                  ->constrained('replies')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('replies')) return;

        Schema::table('replies', function (Blueprint $table) {
            // Drop FK by its auto-generated name to be explicit
            // 'replies_parent_id_foreign' is the default name
            $table->dropForeign('replies_parent_id_foreign');
            $table->dropColumn('parent_id');
        });
    }
};
