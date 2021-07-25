<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcidentVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acident_verifications', function (Blueprint $table) {
            $table->integer('acidentid', 10);
            $table->string('platenumber')->unique();
            $table->foreign('platenumber')->references('platenumber')->on('insuarance')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('platenumber')->references('platenumber')->on('insuarance')->onDelete('cascade')->onUpdate('cascade');
            $table->string('typeofacident');
            $table->string('policeReportNo');
            $table->string('images');
            // $table->string('image2');
            // $table->string('image3');

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
        Schema::dropIfExists('acident_verifications');
    }
}
