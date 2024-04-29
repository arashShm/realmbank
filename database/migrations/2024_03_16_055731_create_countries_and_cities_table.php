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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('countryName')->unique();
            $table->timestamps();

        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('cityName')->unique();
            $table->timestamps();

        });


        Schema::create('city_country' , function(Blueprint $table){
            $table->unsignedBigInteger('city_id') ;
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->unsignedBigInteger('country_id') ;
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->primary(['city_id' , 'country_id']) ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_country');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
    }
};
