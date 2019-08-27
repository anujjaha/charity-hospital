<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataUserLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tier_levels', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('category_id')->nullable();
            $table->integer('user_level')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) 
        {
            $table->integer('user_level')->after('status')->default(1)->nullable();
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

