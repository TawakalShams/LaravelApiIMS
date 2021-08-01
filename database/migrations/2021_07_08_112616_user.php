<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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
            $table->string('platenumber');
            $table->string('create_by');
            $table->timestamp('created_at');
        });

        DB::table('users')->insert([
            [
                'fullName' => 'Tawakal Shams Khamis',
                'email' => 'tawakalshamss@gmail.com',
                'role' => 'Admin',
                'password' => bcrypt('12345'),
                'gender' => 'Male',
                'dob' => '1995-10-10',
                'address' => 'Tomondo',
                'branch' => 'Tomondo',
                'platenumber' => '',
                'phone' => '0774071322',
                'create_by' => 'Admin',
            ]
        ]);
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
