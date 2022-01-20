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
            $table->dateTime('data_range_start', $precision = 0);
            $table->dateTime('data_range_end', $precision = 0);
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
