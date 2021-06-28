<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Acident extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acident', function (Blueprint $table) {
            //   $table->bigIncrements('acidentid');
            $table->integer('acidentid', 10);
            $table->string('platenumber')->unique();
            $table->foreign('platenumber')->references('platenumber')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('typeofacident');
            $table->string('policeReportNo');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');

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
        Schema::dropIfExists('acident');
    }
}
