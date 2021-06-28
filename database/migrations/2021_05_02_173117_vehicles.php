<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class vehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->integer('vehicleid', 10);
            $table->string('platenumber')->unique();
            $table->string('type');
            $table->string('model');
            $table->string('chassiNumber');
            $table->string('seat');
            $table->string('color');
            $table->string('yearOfManufacture');
            $table->string('value');
            $table->string('created_by');
            $table->timestamp('created_at');

            //           'platenumber',

            // 'value',
            // 'created_by'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
