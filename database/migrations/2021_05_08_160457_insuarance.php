<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Insuarance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insuarance', function (Blueprint $table) {
            //  $table->bigIncrements('insuaranceid');
            $table->integer('insuaranceid', 10);
             $table->string('platenumber')->unique();

            // customer
            $table->string('fullName');
            $table->string('gender');
            $table->date('dob');
            $table->string('address');
            $table->string('phone');

            // vehicles
            $table->string('type');
            $table->string('model');
            $table->string('chassiNumber');
            $table->string('seat');
            $table->string('color');
            $table->string('yearOfManufacture');
            $table->string('value');
            // insurance
            // $table->foreign('platenumber')->references('platenumber')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('typeOfInsuarance');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('create_by');
            $table->timestamp('create_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insuarance');
    }
}
