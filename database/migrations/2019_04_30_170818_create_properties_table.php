<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('name');
            $table->string('banner_id')->nullable();
            $table->string('pict_id')->nullable();
            $table->string('pict360_id')->nullable();
            $table->string('video_id')->nullable();
            $table->string('description');
            $table->float('area');
            $table->string('additional_information')->nullable();
            $table->integer('additional_fees')->nullable();
            $table->integer('price');
            $table->string('period');
            $table->string('city_id');
            $table->decimal('longitude',9,6);
            $table->decimal('latitude',9,6);
            $table->string('address');
            $table->integer('total_view')->default(0);
            $table->integer('status')->default(0);
            $table->uuid('propertiable_id');
            $table->string('propertiable_type')->nullable();
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('property_facilities_pivot', function (Blueprint $table) {
            $table->uuid('property_id');
            $table->uuid('facility_id');
            $table->primary(['property_id','facility_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
        Schema::dropIfExists('property_facilities_pivot');
    }
}
