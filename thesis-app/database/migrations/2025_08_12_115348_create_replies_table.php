<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('replies')) return;

        Schema::table('replies', function (Blueprint $table) {
            // Best-effort drops to avoid crashing if FKs aren't present yet
            try { $table->dropForeign(['post_id']); } catch (\Throwable $e) {}
            try { $table->dropForeign(['user_id']); } catch (\Throwable $e) {}

            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down()
    {
        if (!Schema::hasTable('replies')) return;

        Schema::table('replies', function (Blueprint $table) {
            try { $table->dropForeign(['post_id']); } catch (\Throwable $e) {}
            try { $table->dropForeign(['user_id']); } catch (\Throwable $e) {}

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
