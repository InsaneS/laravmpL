<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtags', function($table){
         
            $table->increments('id');
            $table->string('name', 150); 
            $table->integer('HashtagType_id');
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
        //
        Schema::drop('hashtags');
    }
}
