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
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->string('slug')->unique();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->unsignedBigInteger('address_id')->nullable();
            $table->index('address_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->cascadeOnUpdate()
                ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if(app()->isLocal()) {
            Schema::dropIfExists('profiles');
        }
    }
};
