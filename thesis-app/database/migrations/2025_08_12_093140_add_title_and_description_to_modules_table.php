<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('description')->after('title');
        });
    }

    public function down()
    {
       
    }
};
