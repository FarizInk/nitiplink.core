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
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('category_id');
            $table->text('link');
            $table->string('title')->nullable();
            $table->text('note')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->boolean('is_private')->default(false);
            $table->boolean('disable_comment')->default(false);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('category_id')->references('id')->on('categories');
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
