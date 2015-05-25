<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_items', function($table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->integer('order')->nullable();
            $table->string('link')->nullable();
            $table->string('class')->nullable();
            $table->integer('media_id')->nullable();
            $table->integer('gallery_id')->nullable();
            $table->boolean('display')->nullable();
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
        Schema::drop('gallery_items');
    }

}