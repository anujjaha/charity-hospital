<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataPatientXrays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_patient_xrays', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('department_id')->nullable();
            $table->integer('xray_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->string('xray_title')->nullable();
            $table->decimal('xray_cost', 10, 2)->default(0);
            $table->longText('xray_description')->nullable();
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
