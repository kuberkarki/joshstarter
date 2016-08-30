<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //$table->text('bio')->nullable();
            $table->string('video_link')->nullable();
            //$table->date('dob')->nullable();
            //$table->text('description')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('ticket_price')->nullable();
            $table->text('contact_person')->nullable();
            $table->string('land_line')->nullable();
            $table->string('mobile')->nullable();
            $table->string('contact_person_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(array('video_link',  'sponsor', 'ticket_price', 'contact_person', 'land_line', 'mobile', 'contact_person_address'));
        });
    }
}
