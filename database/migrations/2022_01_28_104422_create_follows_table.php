<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('active')->index();
            $table->bigInteger('follow_user_id')->unsigned()->index();
            $table->bigInteger('followed_user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('follow_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('followed_user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
