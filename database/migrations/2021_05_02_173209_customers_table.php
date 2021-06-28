<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // $table->bigIncrements('customerid');
            $table->integer('customerid', 10);
            $table->string('fullName');
            $table->string('gender');
            $table->date('dob');
            $table->string('address');
            $table->string('phone');
            $table->string('platenumber')->unique();
            $table->foreign('platenumber')->references('platenumber')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('created_by');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
