<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table){

            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('apresentation')->nullable();
            $table->string('title');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('all_day');
            $table->date('inicio_inscricoes')->nullable();
            $table->date('fim_inscricoes')->nullable();
            $table->boolean('e_pago');
            $table->string('valor')->nullable();
            $table->string('hora_comple')->nullable();
            $table->string('local')->nullable();
            $table->string('cidade')->nullable();
            $table->string('rua')->nullable();
            $table->string('link')->nullable();

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
        Schema::dropIfExists('events');
    }
}
