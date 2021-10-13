<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('airline', 5);
            $table->string('airline_id');
            $table->string('source_airport', 5);
            $table->string('source_airport_id');
            $table->string('destination_airport', 4);
            $table->string('destination_airport_id');
            $table->enum('codeshare', ['Y', '']);
            $table->smallInteger('stops');
            $table->string('equipment', 3);
            $table->decimal('price', 2);
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
        Schema::dropIfExists('routes');
    }
}
