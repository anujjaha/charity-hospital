<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePatientSurgeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_surgeries', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('patient_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->integer('surgery_id')->nullable();
            $table->longtext('notes')->nullable();
            $table->tinyInteger('status')->default(1);
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
    }
}
