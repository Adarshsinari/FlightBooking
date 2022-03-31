<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_details', function (Blueprint $table) {
            $table->id();
            $table->date('departure_date');
            $table->date('return_date');
            $table->string('departure_city','20');
            $table->foreignId('departure_country_id')->references('id')->on('countries')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('destination_city','20');
            $table->foreignId('destination_country_id')->references('id')->on('countries')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('booking_class','20');
            $table->string('ticket_type','20');
            $table->string('id_proof','30');
            $table->foreignId('person_id')->references('id')->on('person_Details')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('flight_details');
    }
}
