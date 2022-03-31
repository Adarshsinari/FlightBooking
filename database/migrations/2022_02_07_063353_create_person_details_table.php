<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_details', function (Blueprint $table) {
            $table->id();
            $table->string('salutation',10);
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->date('date_of_birth');
            $table->string('email',30);
            $table->string('phone_number',20);
            $table->string('address',20);
            $table->string('zip_code',10);
            $table->foreignId('country_id')->references('id')->on('countries')
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
        Schema::dropIfExists('person_details');
    }
}
