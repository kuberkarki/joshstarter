<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('ads_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ads_id');
            $table->string('name');
            $table->unsignedInteger('minguest');
            $table->unsignedInteger('maxguest');
            $table->float('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('ads_prices');
    }
}
