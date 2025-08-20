<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->text('content')->after('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('content');
        });
    }

    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
