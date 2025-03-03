<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('custom_text')->nullable();
        $table->string('gender');
        $table->json('preferences');
        $table->string('colors');
        $table->string('profile_picture')->default('user.png');;
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['custom_text', 'gender', 'preferences', 'role', 'profile_picture']);
    });
}

};
