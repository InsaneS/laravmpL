<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaifusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waifus', function($table){
            $table->increments('id');
            $table->string('SmName', 150);
            $table->string('FullName', 300);
            $table->string('Archetype', 100);
            $table->string('FullImgUrl', 300);
            $table->integer('Fiction_id');
            $table->integer('author_id');
            
            $table->boolean('active')->default(false);
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
        Schema::drop('waifus');
    }
}
