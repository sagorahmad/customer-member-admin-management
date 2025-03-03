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
        Schema::table('admins', function (Blueprint $table) { // Change to 'admins'
            $table->string('role')->default('admin'); // Add 'role' column
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) { // Change to 'admins'
            $table->dropColumn('role'); // Drop 'role' column
        });
    }

};
