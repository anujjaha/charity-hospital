<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_products', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->string('title');
            $table->decimal('price', 8, 2);
            $table->integer('qty');
            $table->string('image')->default('default.png')->nullable();
            $table->longText('description')->nullable();
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
