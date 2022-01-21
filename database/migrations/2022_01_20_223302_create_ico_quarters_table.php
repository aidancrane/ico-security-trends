<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICOQuartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ico_quarters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('data_range_start');
            $table->integer('data_range_end');
            $table->integer('quarter_1234');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ico_quarters');
    }
}
