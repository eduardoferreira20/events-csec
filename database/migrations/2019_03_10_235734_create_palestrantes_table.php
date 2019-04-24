<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalestrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palestrantes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');

            $table->string('nome');
            $table->string('instituicao');
            $table->string('url')->nullable();
            $table->text('apresentacao')->nullable();
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
        Schema::dropIfExists('palestrantes');
    }
}
