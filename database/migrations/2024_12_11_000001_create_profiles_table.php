```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::table('profile_permission', function (Blueprint $table) {
            $table->dropForeign(['profile_id']);
        });

        Schema::dropIfExists('profiles');
    }
};