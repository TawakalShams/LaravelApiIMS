<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payinsuared extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payinsuared', function (Blueprint $table) {
            // $table->bigIncrements('payid');
            $table->integer('payid', 10);
            $table->integer('insuaranceid')->unique();
            $table->foreign('insuaranceid')->references('insuaranceid')->on('insuarance')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount');
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
        Schema::dropIfExists('payinsuared');
    }
}
