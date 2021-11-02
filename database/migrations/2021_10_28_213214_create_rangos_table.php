<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_user')->unsigned();
            $table->string('name')->default('[ OWNER ]')->nullable(false);
            $table->string('description')->nullable(false);
            $table->string('flags')->default('abcdefghijklmnopqrstuv')->nullable(false);

            $table->foreign('fk_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rangos');
    }
}
