<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('announcements')) return;

        Schema::table('announcements', function (Blueprint $table) {
            // Use longText if you expect long/HTML content
            if (!Schema::hasColumn('announcements', 'content')) {
                $table->longText('content')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('announcements')) return;

        Schema::table('announcements', function (Blueprint $table) {
            if (Schema::hasColumn('announcements', 'content')) {
                $table->dropColumn('content');
            }
        });
    }
};

