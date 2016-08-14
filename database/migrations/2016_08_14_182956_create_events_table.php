<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');$table->string('type');$table->string('location');$table->string('date');$table->string('venue');$table->string('decorator');$table->string('staff');$table->string('cake');$table->string('sound_system');$table->string('flowers');$table->string('bridal_dress');$table->string('video_grapher');$table->string('photo_grapher');$table->string('wedding_car');$table->text('description');$table->text('highlight');$table->string('photo');
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
        Schema::drop('events');
    }
}