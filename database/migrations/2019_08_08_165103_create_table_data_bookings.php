<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bookings', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('doctor_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('queue_number')->nullable()->default(1);
            $table->float('consulting_fees')->nullable();
            $table->longtext('notes')->nullable();
            $table->string('booking_date')->nullable();
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
