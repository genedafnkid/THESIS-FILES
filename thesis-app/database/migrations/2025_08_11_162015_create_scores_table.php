<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();

            // Match users.id (VARCHAR(10))
            $table->string('user_id', 10)->nullable()->index();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->nullOnDelete(); // or ->onDelete('set null')

            // your other columns...
            $table->integer('score')->default(0);
            $table->string('mode')->nullable();

            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};

