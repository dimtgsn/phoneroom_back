<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('phone', 17);

            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        if(app()->isLocal()) {
            Schema::dropIfExists('users');
        }
    }
};
