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
        // Check if the user_profile table exists before dropping the foreign key constraint
        if (Schema::hasTable('user_profile')) {
            Schema::table('user_profile', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        // Drop the users table if it exists
        Schema::dropIfExists('users');
    }

    public function down()
    {
        // Recreate the users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps();
        });

        // Recreate the foreign key constraint in the user_profile table if it exists
        if (Schema::hasTable('user_profile')) {
            Schema::table('user_profile', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }
};