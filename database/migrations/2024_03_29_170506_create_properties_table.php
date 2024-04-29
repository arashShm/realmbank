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
            $table->unsignedBigInteger('user_id') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('country_id') ;
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('city_id') ;
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('image');
            $table->string('region');
            $table->string('area');
            $table->string('plot');
            $table->string('description');
            $table->set('contract' , ['sale' , 'rent']);
            $table->set('status' , ['active' ,'sold' , 'expired'])->default('active');
            $table->unsignedInteger('rooms');
            $table->unsignedBigInteger('price');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('facility_property', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id') ;
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');

            $table->unsignedBigInteger('facility_id') ;
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');

            $table->primary(['property_id' , 'facility_id']) ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_property');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('facilities');
    }
};
