<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_patients', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('validity')->nullable()->default(0);
            $table->integer('age')->nullable()->default(0);
            $table->string('mobile')->nullable();
            $table->string('other_contact')->nullable();
            $table->string('emailid')->nullable();
            $table->longtext('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
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
