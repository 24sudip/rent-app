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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('about_property');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazilla_id');
            $table->string('owner_name');
            $table->string('about_owner');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->integer('property_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
