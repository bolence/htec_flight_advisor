<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('airport_id');
            $table->string('airport_name');
            $table->string('city');
            $table->string('country');
            $table->string('iata', 4)->nullable();
            $table->string('icao', 4)->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->smallInteger('altitude');
            $table->smallInteger('timezone', 2)->nullable();
            $table->enum('dst', ['E', 'A', 'S', 'O', 'Z', 'N', 'U']);
            $table->string('tz_database');
            $table->string('type');
            $table->string('source');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
