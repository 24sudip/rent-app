<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('slug', 200)->nullable();
            $table->string('email', 250);
            $table->string('phone', 20)->nullable();

            $table->string('profile_photo')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            // $table->tinyInteger('verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_for', 50)->nullable();
            $table->tinyInteger('active_status')->default(1);
            $table->enum('role', ['admin','manager','user'])->default('user');
            $table->string('type')->nullable();

            $table->string('profile_visibility')->default('all');
            $table->string('interest_request_access')->default('all');
            $table->string('password', 250);
            $table->string('remember_token', 200)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
