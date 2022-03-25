<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('concert', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date');
            $table->string('performer');
            $table->string('venue');
            $table->string('time');
            $table->string('totalSeats');
            $table->string('posterUrl');
            $table->decimal('price');
            $table->timestamps();
        });

        Schema::create('seat', function (Blueprint $table) {
            $table->id();
            $table->integer('concert_id')->unsigned();
            $table->foreign('concert_id')->references('id')->on('concert')->onDelete('cascade');
            $table->boolean('isBooked');
        });

        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'is_admin' => 1
            )
        );
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
