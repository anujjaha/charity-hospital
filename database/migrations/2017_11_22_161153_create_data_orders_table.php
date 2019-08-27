<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_orders', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('title');
            $table->decimal('subtotal', 8, 2)->default(0);;
            $table->decimal('tax', 8, 2)->default(0);;
            $table->decimal('discount', 8, 2)->default(0);;
            $table->decimal('total_amount', 8, 2)->default(0);;
            $table->decimal('due', 8, 2)->default(0);;
            $table->integer('total_qty')->default(1);
            $table->decimal('total_costc', 8, 2)->default(0);;
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
