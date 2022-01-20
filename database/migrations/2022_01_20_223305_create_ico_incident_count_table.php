<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateICOIncidentCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ico_incident_count', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('quarter_id');
            $table->unsignedBigInteger('ico_body_id');
            $table->unsignedBigInteger('ico_category_id');

            $table->foreign('quarter_id')->references('id')->on('ico_quarters');
            $table->foreign('ico_body_id')->references('id')->on('ico_bodies');
            $table->foreign('ico_category_id')->references('id')->on('ico_categories');
            $table->integer('incident_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ico_incident_count');
    }
}
