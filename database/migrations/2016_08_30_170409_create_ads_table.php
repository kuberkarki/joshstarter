<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('ads', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');$table->string('location');$table->text('description');$table->string('photo');$table->string('video');$table->string('available_date');$table->string('price');$table->text('additional_package_offer');$table->string('additional_ads_title');$table->string('price_type');$table->string('publish');
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
        Schema::drop('ads');
    }
}