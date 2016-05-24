<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('patient_id');
            $table->timestamps();
        });

        Schema::table('booking_patients', function($table) {
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking_patients');
    }
}
