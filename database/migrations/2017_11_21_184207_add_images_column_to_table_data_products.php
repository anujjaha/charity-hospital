<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesColumnToTableDataProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_products', function (Blueprint $table) 
        {
            $table->string('image1')->after('image')->nullable();
            $table->string('image2')->after('image1')->nullable();
            $table->string('image3')->after('image2')->nullable();
            $table->string('image4')->after('image3')->nullable();
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
