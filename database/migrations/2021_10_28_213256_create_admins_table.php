<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_server')->unsigned();
            $table->unsignedBigInteger('fk_rango')->unsigned();
            $table->string('steamid')->nullable(false);
            $table->string('name')->nullable(false);
            $table->integer('type')->default(1)->nullable(false);
            $table->string('password')->nullable(false);
            $table->date('date')->nullable(false);

            $table->foreign('fk_server')->references('id')->on('servers');
            $table->foreign('fk_rango')->references('id')->on('rangos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
