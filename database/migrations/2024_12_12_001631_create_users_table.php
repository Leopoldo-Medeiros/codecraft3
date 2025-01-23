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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incremental ID
            $table->string('full_name'); // Required field
            $table->string('email')->unique(); // Unique email field
            $table->string('password'); // Ensure this matches your model's property
            $table->string('phone')->nullable(); // Optional field
            $table->string('profile_image')->nullable(); // Optional field
            $table->string('recovery_token')->nullable(); // Optional field
            $table->timestamp('token_expiration')->nullable(); // Optional field
            $table->boolean('two_factor_auth')->default(false); // Default false
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Default status
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop users table if it exists
    }
};