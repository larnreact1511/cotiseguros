<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequencyofpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencyofpayments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idquote');
            $table->integer('idadmin');
            $table->tinyInteger('tipopago')->default(0);
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->float('montoestimado');
            $table->tinyInteger('estadodepago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequencyofpayments');
    }
}
