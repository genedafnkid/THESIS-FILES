<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('user_id', 10); // match users.id
            $table->text('content');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('replies')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
