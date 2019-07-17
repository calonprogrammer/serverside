<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('unit_type');
            $table->string('unit_condition')->nullable();
            $table->integer('unit_floor');
            $table->string('furnished');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartements');
    }
}
