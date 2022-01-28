<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('post_id')->unsigned()->nullable()->default(null)->index();
            $table->string('text')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
