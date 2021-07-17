<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->bigIncrements('agentid');
            $table->integer('agentid', 10);
            $table->string('fullName');
            $table->string('email');
            $table->string('role');
            $table->string('password');
            $table->string('gender');
            $table->date('dob');
            $table->string('address');
            $table->string('branch');
            $table->string('phone');
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
        Schema::dropIfExists('users');
    }
}
