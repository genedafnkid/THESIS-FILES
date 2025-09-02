<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // If the table exists already and is broken, drop it first (safe if it's empty in dev)
        if (Schema::hasTable('badge_user')) {
            Schema::drop('badge_user');
        }

        // Ensure parent tables exist before the pivot
        if (!Schema::hasTable('users') || !Schema::hasTable('badges')) {
            throw new \RuntimeException('Users and badges tables must exist before creating badge_user.');
        }

        Schema::create('badge_user', function (Blueprint $table) {
            // Match the parent columns' types (unsigned BIGINT)
            $table->string('user_id');
            $table->unsignedBigInteger('badge_id');
            $table->timestamp('earned_at')->nullable();
            $table->timestamps();

            // Indexes first (MySQL requirement for FKs)
            $table->index(columns: 'user_id');
            $table->index('badge_id');

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');

            // Optional: prevent duplicates
            $table->unique(['user_id', 'badge_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('badge_user');
    }
};
