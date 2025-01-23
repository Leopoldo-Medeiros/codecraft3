```php
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
        // Drop the table if it already exists
        Schema::dropIfExists('profile_permission');

        // Create the table
        Schema::create('profile_permission', function (Blueprint $table) {
            $table->id();
            $table->uuid('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->uuid('permission_id'); // Ensure this matches the type in the permissions table
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profile_permission');
    }
};