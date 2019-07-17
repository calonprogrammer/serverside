<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('channel_id');
            $table->text('message')->nullable();
            $table->uuid('sender');
            $table->uuid('receiver')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamp('sent_time');
            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels')->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
