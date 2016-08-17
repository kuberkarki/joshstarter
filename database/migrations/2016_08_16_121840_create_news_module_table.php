<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('news_category_id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news_comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('news_id');
            $table->string('name');
            $table->string('email');
            $table->string('website')->nullable();
            $table->text('comment');
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
        Schema::drop('news_comments');

        Schema::drop('news');

        Schema::drop('news_categories');
    }
}
