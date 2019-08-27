<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_order_items', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->integer('status')->default(1);
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
