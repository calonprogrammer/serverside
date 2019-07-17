<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('premium_id')->nullable();
            $table->string('username')->nullable();
            $table->string('picture_id')->nullable();
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->dateTime('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('type');
            $table->integer('ban');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
