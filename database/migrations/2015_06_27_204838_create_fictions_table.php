<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('fictions', function($table){
         
            $table->increments('id');
            $table->string('name', 150);
            $table->string('previewImgUrl', 300);
            $table->string('FullImgUrl', 300);
            $table->string('url', 300);
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
        Schema::drop('fictions');
    }
}
