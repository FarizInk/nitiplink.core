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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->text('link');
            $table->text('note')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('meta_image')->nullable();
            
            $table->unsignedBigInteger('linkable_id');
            $table->string('linkable_type');
            $table->unsignedBigInteger('created_by_id');
            $table->string('created_by');
            $table->timestamps();

            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
};
