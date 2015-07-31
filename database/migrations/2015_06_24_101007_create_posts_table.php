<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Posts', function($table){
         
            $table->increments('id');
            //$table->string('title', 150);
            $table->string('previewIMG', 300); 
            $table->string('fullIMG', 300);
            $table->string('author_id', 100);
            $table->date('publishDate');
            $table->boolean('Published')->default(false);
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
        Schema::drop('Posts');
    }
}
