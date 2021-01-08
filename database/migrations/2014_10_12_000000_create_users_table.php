<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('dni')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('password');
            $table->integer('role_id');
            $table->integer('district_id')->nullable();
            $table->string('paused_by')->nullable();
            $table->string('paused_for')->nullable();
            $table->datetime('paused_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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