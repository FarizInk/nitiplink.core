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
        Schema::create('tag_link', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('link_id');
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags');
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
        Schema::dropIfExists('tag_link');
    }
};
