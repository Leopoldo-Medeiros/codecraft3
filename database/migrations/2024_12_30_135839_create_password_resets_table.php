<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        // Ensure the users table exists before creating the password_resets table
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('full_name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('phone')->nullable();
                $table->string('profile_image')->nullable();
                $table->string('recovery_token')->nullable();
                $table->timestamp('token_expiration')->nullable();
                $table->boolean('two_factor_auth')->default(false);
                $table->enum('status', ['Active', 'Inactive'])->default('Active');
                $table->timestamps();
            });
        }

        // Create the password_resets table
        Schema::create('password_resets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('token')->unique();
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}