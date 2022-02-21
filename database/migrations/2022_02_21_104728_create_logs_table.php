<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('caetgory_id')->nullable();
            $table->unsignedBigInteger('link_id')->nullable();
            $table->text('messages');
            $table->string('type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('link_id')->references('id')->on('links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
